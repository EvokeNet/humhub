<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

use app\modules\matching_questions\models\Qualities;

$this->title = Yii::t('MissionsModule.base', 'Quizzes Questions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Questions'), 'url' => ['index-questions']];
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
    </div>
    <div class="panel-body">

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Question'), ['create-quiz'], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($questions) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'ID Code'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Question Headline'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Quality'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Level'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($questions as $question): ?>
                    <tr>
                        <td><?php echo $question->id; ?></td>
                        <td><?php echo $question->question_headline; ?></td>
                        <td><?php echo $question->quality->name; ?></td>
                        <td><?php echo $question->level_id; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'View Answers'), 
                                ['index-quiz-answers', 'id' => $question->id], array('class' => 'btn btn-success btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-quiz', 'id' => $question->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-quiz', 'id' => $question->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this question?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No question translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


