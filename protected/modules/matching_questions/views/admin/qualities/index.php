<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\matching_questions\models\QualitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('MatchingModule.base', 'Qualities');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MatchingModule.base', 'Qualities'); ?></h3>
    </div>
    <div class="panel-body">

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MatchingModule.base', 'Create new Quality'), ['create-qualities'], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($qualities) != 0): ?>
        
            <table class="table">
                <tr>
                    <!--<th><?php echo Yii::t('MatchingModule.base', 'ID Code'); ?></th>-->
                    <th><?php echo Yii::t('MatchingModule.base', 'Name'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Short Name'); ?></th>
                    <th><?php echo Yii::t('MatchingModule.base', 'Description'); ?></th>
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
                                Yii::t('MatchingModule.base', 'View Powers'),
                                ['index-quality-powers', 'id' => $quality->id], array('class' => 'btn btn-info btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'View translations'),
                                ['index-quality-translations', 'id' => $quality->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Update'),
                                ['update-qualities', 'id' => $quality->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MatchingModule.base', 'Delete'),
                                ['delete-qualities', 'id' => $quality->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MatchingModule.base', 'Are you sure you want to delete this quality?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MatchingModule.base', 'No qualities created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
