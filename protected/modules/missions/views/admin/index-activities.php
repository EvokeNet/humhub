<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use humhub\modules\missions\models\Missions;
use humhub\modules\missions\models\Objectives;

$this->title = Yii::t('MissionsModule.views_admin_add-activities', 'Activity');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.views_admin_add', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
        
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.views_admin_index-activities', 'Activities - Mission ').$mission->title; ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MissionsModule.views_admin_index-activities', 'Create new Activity'), ['add-activities', 'id' => $mission->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($activities) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.views_admin_index-activities', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.views_admin_index-activities', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.views_admin_index-activities', 'Mission'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($activities as $activity): ?>
                    <tr>
                        <td><?php echo $activity->title; ?></td>
                        <td><?php echo $activity->description; ?></td>
                        <td><?php echo $activity->mission->title; ?></td>
                        <td>
                            <?php echo Html::a('Edit', ['edit-activities', 'id' => $activity->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a('Delete', ['delete-activities', 'id' => $activity->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.views_admin_index-activities', 'No activities created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


