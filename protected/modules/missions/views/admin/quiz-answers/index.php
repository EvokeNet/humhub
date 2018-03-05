<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Quiz Question Answers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Question'), 'url' => ['index-question']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Question ID #{id}', array('id' => $question->id)), 'url' => ['index-quiz']];
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

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Answer'), ['create-quiz-answer', 'id' => $question->id], array('class' => 'btn btn-success')); ?></div>
        
        <?php if (count($answers) != 0): ?>

            <h6><?php echo Yii::t('MissionsModule.base', 'QUESTION: {question}', array('question' => $question->question_headline)); ?></h6><br>
            <table class="table">
                <tr>
                    <!--<th><?php //echo Yii::t('MissionsModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('MissionsModule.base', 'Answer Headline'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'True or False'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($answers as $answer): ?>
                    <tr>
                        <!--<td><?php //echo $tag->id_code; ?></td>-->
                        <td><?php echo $answer->answer_headline; ?></td>
                        <td><?php echo ($answer->right_answer == 0) ? Yii::t('MissionsModule.base', 'True') : Yii::t('MissionsModule.base', 'False'); ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-quiz-answer', 'id' => $answer->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-quiz-answer', 'id' => $answer->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this answer?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No quiz answer created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


