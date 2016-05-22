<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\QualitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingQuestionsModule.base', 'Qualities');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MatchingQuestionsModule.base', 'Qualities'); ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MatchingQuestionsModule.base', 'Create new Quality'), ['create-qualities'], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($qualities) != 0): ?>
        
            <table class="table">
                <tr>
                    <!--<th><?php echo Yii::t('MatchingQuestionsModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Name'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Short Name'); ?></th>
                    <th><?php echo Yii::t('MatchingQuestionsModule.base', 'Description'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($qualities as $quality): ?>
                    <tr>
                        <!--<td><?php //echo $quality->id_code; ?></td>-->
                        <td><?php echo $quality->name; ?></td>
                        <td><?php echo $quality->short_name; ?></td>
                        <td><?php echo $quality->description; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'View translations'),
                                ['index-quality-translations', 'id' => $quality->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'Update'),
                                ['update-qualities', 'id' => $quality->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingQuestionsModule.base', 'Delete'),
                                ['delete-qualities', 'id' => $quality->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingQuestionsModule.base', 'Are you sure you want to delete this quality?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingQuestionsModule.base', 'No qualities created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
