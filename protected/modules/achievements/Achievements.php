<?php

namespace app\modules\achievements;

/**
 * achievements module definition class
 */
class Achievements extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\achievements\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //$this->registerTranslations();
    }
    
    // public function registerTranslations()
    // {
    //     Yii::$app->i18n->translations['modules/achievements/*'] = [
    //         'class' => 'yii\i18n\PhpMessageSource',
    //         'sourceLanguage' => 'en-US',
    //         'basePath' => 'humhub/modules/achievements/messages',
    //         'fileMap' => [
    //             'modules/achievements/views' => 'achievements.php',
    //         ],
    //     ];
    // }
    
    // public static function t($category, $message, $params = [], $language = null)
    // {
    //     return Yii::t('modules/achievements/' . $category, $message, $params, $language);
    // }
        
}
