<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\modules\missions\models\Missions;
use humhub\modules\missions\models\Objectives;

$this->title = Yii::t('MissionsModule.base', 'Activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index', 'id' => $mission->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$mission->id_code;
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

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Activity'), ['create-activities', 'id' => $mission->id], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($activities) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'ID Code'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Mission'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?php echo $activity->id_code; ?></td>
                        <td><?php echo $activity->title; ?></td>
                        <td><?php echo $activity->description; ?></td>
                        <td><?php echo $activity->mission->id_code; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'View Powers'),
                                ['index-activity-powers', 'id' => $activity->id], array('class' => 'btn btn-info btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'View Translations'),
                                ['index-activity-translations', 'id' => $activity->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-activities', 'id' => $activity->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-activities', 'id' => $activity->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this activity?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No activities created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


