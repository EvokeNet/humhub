<?php

use yii\helpers\Html;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Missions');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.base', 'Missions'); ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Mission'), ['create'], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($missions) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'ID Code'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($missions as $mission): ?>
                    <tr>
                        <td><?php echo $mission->id_code; ?></td>
                        <td><?php echo $mission->title; ?></td>
                        <td><?php echo $mission->description; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'View translations'), 
                                ['index-mission-translations', 'id' => $mission->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'View Activities'), 
                                ['index-activities', 'id' => $mission->id], array('class' => 'btn btn-success btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update', 'id' => $mission->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete', 'id' => $mission->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this mission?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No missions created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>


