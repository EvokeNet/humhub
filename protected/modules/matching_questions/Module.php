<?php

namespace humhub\modules\matching_questions;

use Yii;
use humhub\models\Setting;
use yii\helpers\Url;

use app\modules\matching_questions\models\MatchingQuestions;
use app\modules\matching_questions\models\MatchingQuestionTranslations;
use app\modules\matching_questions\models\MatchingAnswers;
use app\modules\matching_questions\models\MatchingAnswerTranslations;
use app\modules\matching_questions\models\Qualities;
use app\modules\matching_questions\models\QualityTranslations;
use app\modules\matching_questions\models\SuperheroIdentities;
use app\modules\matching_questions\models\SuperheroIdentityTranslations;

class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/matching_questions/config']);
    }

    /**
     * @inheritdoc
     */
    public function enable()
    {
        parent::enable();
    }
    
    /**
     * @inheritdoc
     */
    public function disable()
    {
        foreach (MatchingQuestions::find()->all() as $item) {
            $item->delete();
        }

        foreach (MatchingQuestionTranslations::find()->all() as $item) {
            $item->delete();
        }
        
        foreach (MatchingAnswers::find()->all() as $item) {
            $item->delete();
        }

        foreach (MatchingAnswerTranslations::find()->all() as $item) {
            $item->delete();
        }
        
        foreach (Qualities::find()->all() as $item) {
            $item->delete();
        }

        foreach (QualityTranslations::find()->all() as $item) {
            $item->delete();
        }
        
        foreach (SuperheroIdentities::find()->all() as $item) {
            $item->delete();
        }

        foreach (SuperheroIdentityTranslations::find()->all() as $item) {
            $item->delete();
        }

        parent::disable();
    }
    
<<<<<<< HEAD

=======

>>>>>>> origin/gf-evidences
}

?>
