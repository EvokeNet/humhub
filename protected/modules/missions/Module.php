<?php

    namespace humhub\modules\missions;

    use Yii;
    use humhub\models\Setting;
    use yii\helpers\Url;

    /**
    * BirthdayModule is responsible for the the birthday functions.
    * 
    * @author Sebastian Stumpf
    */
    class Module extends \humhub\components\Module
    {
        
        public function init()
        {
            parent::init();
            
            // custom initialization code goes here
            $this->registerTranslations();
        }
        
        public function registerTranslations()
        {
            Yii::$app->i18n->translations['modules/missions/*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => 'humhub/modules/missions/messages',
                'fileMap' => [
                    'modules/missions/views' => 'missions.php',
                ],
            ];
        }
        
        public static function t($category, $message, $params = [], $language = null)
        {
            return Yii::t('modules/missions/' . $category, $message, $params, $language);
        }
    
        /**
        * @inheritdoc
        */
        // public function getConfigUrl()
        // {
        //     return Url::to(['/missions/config']);
        // }

        /**
        * @inheritdoc
        */
        // public function enable()
        // {
        //     parent::enable();
        //     Setting::Set('shownDays', 2, 'birthday');
        // }

    }

?>