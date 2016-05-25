<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Activity Powers');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$activity->mission->id_code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Activities'), 'url' => ['index-activities', 'id' => $activity->mission->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Activity').' '.$activity->id_code;
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

        <?php echo Html::a(Yii::t('MissionsModule.base', 'Add new Power'), ['create-activity-powers', 'id' => $activity->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($activity_powers) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Type (Primary/Secondary)'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Points'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($activity_powers as $power): ?>
                    <tr>
                        <td><?php echo $power->power->title; ?></td>
                        <td><?php echo $power->power->description; ?></td>
                        <td><?php 
                            
                            if($power->flag == 0){
                                echo "Primary Power";
                            } else {
                                echo "Secondary Power";
                            } 
                            
                            ?></td>
                        <td><?php echo $power->value; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-activity-powers', 'id' => $power->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this power?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No activity powers created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
