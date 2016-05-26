<?php

namespace app\modules\missions;

use Yii;

/**
 * missions module definition class
 */
//class Missions extends \humhub\components\Module
class Missions extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\missions\controllers';

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
    //     Yii::$app->i18n->translations['modules/missions/*'] = [
    //         'class' => 'yii\i18n\PhpMessageSource',
    //         'sourceLanguage' => 'en-US',
    //         'basePath' => 'humhub/modules/missions/messages',
    //         'fileMap' => [
    //             'modules/missions/views' => 'missions.php',
    //         ],
    //     ];
    // }
    
    // public static function t($category, $message, $params = [], $language = null)
    // {
    //     return Yii::t('modules/missions/' . $category, $message, $params, $language);
    // }
    
}