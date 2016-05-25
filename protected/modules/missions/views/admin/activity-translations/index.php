<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Translations');
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

        <?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Translation'), ['create-activity-translations', 'id' => $activity->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($activity_translations) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($activity_translations as $activity): ?>
                    <tr>
                        <td><?php echo $activity->title; ?></td>
                        <td><?php echo $activity->description; ?></td>
                        <td><?php echo $activity->language->language; ?></td>
                        <td>
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-activity-translations', 'id' => $activity->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-activity-translations', 'id' => $activity->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.base', 'Are you sure you want to delete this translation?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.base', 'No activity translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>