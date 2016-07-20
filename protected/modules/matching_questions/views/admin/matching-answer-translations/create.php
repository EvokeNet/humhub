<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;


/* @var $this yii\web\View */
/* @var $model humhub\modules\matching_questions\models\MatchingAnswerTranslations */

$this->title = Yii::t('MatchingModule.base', 'Create Matching Answer Translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Matching Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('MatchingModule.base', 'Matching Question').' '.$matching_answer->matchingQuestion->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Matching Answers'), 'url' => ['index-matching-answers', 'id' => $matching_answer->matching_question_id]];
$this->params['breadcrumbs'][] = Yii::t('MatchingModule.base', 'Matching Answer').' '.$matching_answer->id_code;
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong><?php echo $this->title; ?></strong></div>
    <div class="panel-body">
        
        <div class="matching-questions-create">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
        
    </div>
</div>
