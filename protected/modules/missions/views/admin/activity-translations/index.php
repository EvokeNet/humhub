<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.views_admin_add-activity-translations', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Missions'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $activity->title, 'url' => ['view', 'id' => $activity->id]];
$this->params['breadcrumbs'][] = $activity->title.' - '.$this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.views_admin_add-activity-translations', 'Activity Translations'); ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MissionsModule.views_admin_add-activity-translations', 'Create new Translation'), ['add-activity-translations', 'id' => $activity->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($activity_translations) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.views_admin_add-activity-translations', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.views_admin_add-activity-translations', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.views_admin_add-activity-translations', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($activity_translations as $activity): ?>
                    <tr>
                        <td><?php echo $activity->title; ?></td>
                        <td><?php echo $activity->description; ?></td>
                        <td><?php echo $activity->language->code; ?></td>
                        <td>
                            <?php echo Html::a('Edit', ['edit-activity-translations', 'id' => $activity->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a('Delete', ['delete-activity-translations', 'id' => $activity->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.views_admin_add-activity-translations', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.views_admin_add-activity-translations', 'No activity translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>