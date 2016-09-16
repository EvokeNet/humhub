<?php

namespace app\modules\static;

/**
 * statics module definition class
 */
class Statics extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\statics\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    { 
        parent::init();

        // custom initialization code goes here
        $this->registerTranslations();
    }
    
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/statics/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => 'humhub/modules/statics/messages',
            'fileMap' => [
                'modules/statics/views' => 'statics.php',
            ],
        ];
    }
    
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/statics/' . $category, $message, $params, $language);
    }
        
}
