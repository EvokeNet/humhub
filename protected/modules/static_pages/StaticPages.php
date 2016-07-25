<?php

namespace app\modules\static_pages;

/**
 * static_pages module definition class
 */
class StaticPages extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\static_pages\controllers';

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
        Yii::$app->i18n->translations['modules/static_pages/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => 'humhub/modules/static_pages/messages',
            'fileMap' => [
                'modules/static_pages/views' => 'static_pages.php',
            ],
        ];
    }
    
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/static_pages/' . $category, $message, $params, $language);
    }
        
}
