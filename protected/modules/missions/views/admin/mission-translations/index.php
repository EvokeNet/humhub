<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.views_admin_add-mission-translations', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Missions'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $mission->title, 'url' => ['view', 'id' => $mission->id]];
$this->params['breadcrumbs'][] = $mission->title.' - '.$this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', 'Mission Translations'); ?></h3>
    </div>
    <div class="panel-body">

        <?php echo Html::a(Yii::t('MissionsModule.views_admin_add-mission-translations', 'Create new Translation'), ['add-mission-translations', 'id' => $mission->id], array('class' => 'btn btn-success')); ?>
        
        <br><br>
        
        <?php if (count($mission_translations) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', 'Title'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', 'Description'); ?></th>
                    <th><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($mission_translations as $mission): ?>
                    <tr>
                        <td><?php echo $mission->title; ?></td>
                        <td><?php echo $mission->description; ?></td>
                        <td><?php echo $mission->language->code; ?></td>
                        <td>
                            <?php echo Html::a('Edit', ['edit-mission-translations', 'id' => $mission->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a('Delete', ['delete-mission-translations', 'id' => $mission->id], array(
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('MissionsModule.views_admin_add-mission-translations', 'Are you sure you want to delete this item?'),
                                    'method' => 'post',
                                ],
                                )); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php else: ?>

            <p><?php echo Yii::t('MissionsModule.views_admin_add-mission-translations', 'No mission translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
