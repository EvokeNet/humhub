<?php
/**
 * Translatable
 *
 * Transparent attribute translation for ActiveRecords.
 *
 * @version 1.1.0-dev
 * @author Michael Härtl <haertl.mike@gmail.com>
 */
class Translatable extends CActiveRecordBehavior
{
    /**
     * @var string name of relation to the translation table. Default is 'translation'.
     */
    public $translationRelation = 'translations';

    /**
     * @var string name of language column in translation table. Default is 'language'.
     */
    public $languageColumn = 'language';

    /**
     * @var array list of attributes to translate. You must add validation rules to the owner for each!
     */
    public $translationAttributes = array();

    /**
     * @var array default columns in main table, indexed by attribute name. Used if no translation found.
     */
    public $fallbackColumns = array();
    
    /**
     * @var boolean whether to suppress the automatic creation of a translation model if none exists yet. Fallback columns will still work. Default is false.
     */
    public $disableTranslationModel = false;

    /**
     * @var string the currently used language for the owner object
     */
    private $_language;

    /**
     * @var string the language used for query. Used internally.
     */
    private $_queryLanguage;

    /**
     * @var mixed the languages used for query. Used internally.
     */
    private $_allQueryLanguages;

    /**
     * @var CActiveRecord the translation model
     */
    private $_tModels = array();

    /**
     * @var CActiveRecord the fallback translation model
     */
    private $_fbModel;

    /**
     * Make translated attributes readable
     */
    public function __get($name)
    {
        if(!in_array($name, $this->translationAttributes))
            return parent::__get($name);

        if (!$this->disableTranslationModel) {
            $model = $this->getTranslationModel();
            if(!empty($model->$name))
                return $model->$name;
        }

        if($this->_fbModel!==null && !empty($this->_fbModel->$name))
            return $this->_fbModel->$name;

        if(isset($this->fallbackColumns[$name]))
            return $this->owner->{$this->fallbackColumns[$name]};

        return '';
    }

    /**
     * Make translated attributes writeable
     */
    public function __set($name, $value)
    {
        if(!$this->disableTranslationModel && in_array($name, $this->translationAttributes))
            $this->getTranslationModel()->$name = $value;
        else
            parent::__set($name, $value);
    }

    /**
     * Expose translatable attribues as readable
     */
    public function canGetProperty($name)
    {
        return in_array($name, $this->translationAttributes) ? true : parent::canGetProperty($name);
    }

    /**
     * Expose translatable attribues as writeable
     */
    public function canSetProperty($name)
    {
        return in_array($name, $this->translationAttributes) ? true : parent::canSetProperty($name);
    }

    /**
     * Apply language JOIN condition before every query
     */
    public function beforeFind($event)
    {
        if($this->_allQueryLanguages===null)
        {
            $language   = $this->_queryLanguage===null ? $this->getLanguage() : $this->_queryLanguage;
            $on         = "{$this->translationRelation}.{$this->languageColumn}='$language'";
        }
        else
        {
            $on = $this->_allQueryLanguages===true ? null :
                "{$this->translationRelation}.{$this->languageColumn} IN ('".implode("','",$this->_allQueryLanguages)."')";
        }
        $this->owner->getDbCriteria()->mergeWith(array(
            'with'=>array(
                $this->translationRelation => array(
                    'on'        => $on,
                    'together'  => true,
                ),
            ),
        ));
    }

    /**
     * Save translation model after owner was saved
     */
    public function afterSave($event)
    {
        $this->saveTranslation();
    }

    /**
     * Save the current translation model
     *
     * @return bool wether the translation model was saved successfully
     */
    public function saveTranslation()
    {
        $model      = $this->getTranslationModel();
        $pk         = $this->owner->metaData->relations[$this->translationRelation]->foreignKey;
        $model->$pk = $this->owner->primaryKey;

        return $model->save();
    }

    /**
     * Set language on new behavior instance and reset scope language
     */
    public function afterFind($event)
    {
        // We need the behavior instance which was attached to the model!
        $behavior = $this->owner->model()->asa(get_class($this)); /* @var Translatable $behavior */

        $this->_language = $behavior->_queryLanguage;
        $behavior->_queryLanguage = null;
    }

    /**
     * Named scope to query for multiple language records
     *
     * @param mixed $languages an array of language codes or null for all languages
     */
    public function allLanguages($languages=null)
    {
        $this->_allQueryLanguages = $languages===null ? true : $languages;
        return $this->owner;
    }

    /**
     * Named scope to select a language
     *
     * @param string language code
     */
    public function language($language)
    {
        $this->_queryLanguage = $language;
        return $this->owner;
    }

    /**
     * @param string $value the language of this model
     */
    public function setLanguage($value)
    {
        if(!isset($this->_tModels[$value]))
            $this->_tModels[$value] = $this->loadTranslationModel($value);

        $this->_language = $value;
    }

    /**
     * @return string the language of this model
     */
    public function getLanguage()
    {
        if($this->_language===null)
            $this->_language = Yii::app()->language;

        return $this->_language;
    }

    /**
     * @param mixed $value the fallback language to use. `true` for application language or null to disable.
     * @throws CException if there was a problem setting the fallback language
     */
    public function setFallbackLanguage($value)
    {
        if($value===true)
            $value = Yii::app()->language;
        elseif($value===null)
        {
            $this->_fbModel = null;
            return;
        }

        if($this->owner->isNewRecord)
            throw new CException('Fallback language can not be set on new records');

        $this->_fbModel = $this->loadTranslationModel($value);
    }

    /**
     * @return mixed the fallback language or null if none
     */
    public function getFallbackLanguage()
    {
        return $this->_fbModel===null ? null : $this->_fbModel->language;
    }

    /**
     * @return CActiveRecord the related translation record. Can be a new record if owner is new.
     */
    public function getTranslationModel($language=null)
    {
        if($language===null)
            $language = $this->getLanguage();

        if(!isset($this->_tModels[$language]))
        {
            if(!$this->owner->isNewRecord)
            {
                $translations = $this->owner->getRelated($this->translationRelation);
                if (isset($translations[0])) {
                    throw new CException("Translatable has detected a numeric index on '{$this->translationRelation}', relation must be defined with an index on '{$this->languageColumn}'.");
                }
                if(isset($translations[$language]))
                    $this->_tModels[$language] = $translations[$language];
            }

            if(!isset($this->_tModels[$language]))
            {
                $className = $this->owner->metaData->relations[$this->translationRelation]->className;
                $this->_tModels[$language] = new $className;
                $languageColumn = $this->languageColumn;
                $this->_tModels[$language]->$languageColumn = $language;
            }
        }

        return $this->_tModels[$language];
    }

    /**
     * Load the translation model or create a new one
     *
     * @param string $language the language code
     * @param bool $createNew wether to return a new model if none found. Defaults to true.
     * @return CActiveRecord the translation model
     */
    private function loadTranslationModel($language, $createNew = true)
    {
        $relation = $this->owner->metaData->relations[$this->translationRelation];
        $class = $relation->className;
        $pkName = $relation->foreignKey;

        // Try to load existant translation for that language
        $model = CActiveRecord::model($class)->find("$pkName=:p AND {$this->languageColumn}=:l",array(
            ':p' => $this->owner->primaryKey,
            ':l' => $language,
        ));

        // If no model existed, create a new one
        if($model===null)
        {
            $model = new $class;
            $column = $this->languageColumn;
            $model->$column = $language;
        }

        return $model;
    }
}
