<?php

namespace app\modules\matching_questions;

use Yii;

/**
 * matching_questions module definition class
 */
//class MatchingQuestions extends \humhub\components\Module
class MatchingQuestions extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\matching_questions\controllers';

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
        Yii::$app->i18n->translations['modules/matching_questions/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => 'humhub/modules/matching_questions/messages',
            'fileMap' => [
                'modules/matching_questions/views' => 'matching_questions.php',
            ],
        ];
    }
    
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/matching_questions/' . $category, $message, $params, $language);
    }
}