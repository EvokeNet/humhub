<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\MatchingQuestionTranslationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingQuestionsModule.base', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingQuestionsModule.base', 'Matching Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('MatchingQuestionsModule.base', 'Matching Question').' '.$matching_answer->matchingQuestion->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingQuestionsModule.base', 'Matching Answers'), 'url' => ['index-matching-answers', 'id' => $matching_answer->matching_question_id]];
$this->params['breadcrumbs'][] = Yii::t('MatchingQuestionsModule.base', 'Matching Answer').' '.$matching_answer->id_code;
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MatchingQuestionsModule.base', 'Translations'); ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MatchingQuestionsModule.base', 'Create new Translation'), ['create-matching-answer-translations', 'id' => $matching_answer->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($matching_answers) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($matching_answers as $matching): ?>
                    <tr>
                        <td><?php echo $matching->description; ?></td>
                        <td><?php echo $matching->language->code; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'Update'),
                                ['update-matching-answer-translations', 'id' => $matching->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'Delete'),
                                ['delete-matching-answer-translations', 'id' => $matching->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingQuestionsModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingQuestionsModule.base', 'No matching question translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
