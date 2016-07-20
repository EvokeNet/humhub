<?php

namespace app\modules\stats;

/**
 * stats module definition class
 */
class Stats extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\stats\controllers';

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
        Yii::$app->i18n->translations['modules/stats/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => 'humhub/modules/stats/messages',
            'fileMap' => [
                'modules/stats/views' => 'stats.php',
            ],
        ];
    }
    
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/stats/' . $category, $message, $params, $language);
    }
        
}
