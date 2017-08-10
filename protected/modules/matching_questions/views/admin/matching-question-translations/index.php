<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\MatchingQuestionTranslationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingModule.base', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MatchingModule.base', 'Matching Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('MatchingModule.base', 'Matching Question').' '.$matching_question->id_code;
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MatchingModule.base', 'Translations'); ?></h3>
    </div>
    <div class="panel-body">

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MatchingModule.base', 'Create new Translation'), ['create-matching-question-translations', 'id' => $matching_question->id], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($matching_questions) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MatchingModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($matching_questions as $matching): ?>
                    <tr>
                        <td><?php echo $matching->description; ?></td>
                        <td><?php echo $matching->language->language; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Update'),
                                ['update-matching-question-translations', 'id' => $matching->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Delete'),
                                ['delete-matching-question-translations', 'id' => $matching->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingModule.base', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingModule.base', 'No matching question translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
