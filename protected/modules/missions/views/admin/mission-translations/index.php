<?php

use yii\helpers\Html;
use yii\grid\GridView;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Translations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $mission->title, 'url' => ['view', 'id' => $mission->id]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission').' '.$mission->id_code;
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.base', 'Translations'); ?></h3>
    </div>
    <div class="panel-body">

        <div style="position: absolute; top: 10px; right: 10px;"><?php echo Html::a(Yii::t('MissionsModule.base', 'Create new Translation'), ['create-mission-translations', 'id' => $mission->id], array('class' => 'btn btn-success')); ?></div>
        
        <br><br>
        
        <?php if (count($mission_translations) != 0): ?>
        
            <table class="table">
                <tr>
                    <th><?php echo Yii::t('MissionsModule.base', 'Title'); ?></th>
                    <!--<th><?php //echo Yii::t('MissionsModule.base', 'Description'); ?></th>-->
                    <th><?php echo Yii::t('MissionsModule.base', 'Language'); ?></th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($mission_translations as $m): ?>
                    <tr>
                        <td><?php echo $m->title; ?></td>
                        <!--<td><?php //echo $m->description; ?></td>-->
                        <td><?php echo $m->language->language; ?></td>
                        <td>
                            <?php //echo Html::a(
                                //Yii::t('MissionsModule.base', 'View'),
                                //['view-mission-translations', 'id' => $m->id], array('class' => 'btn btn-warning btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Update'),
                                ['update-mission-translations', 'id' => $m->id], array('class' => 'btn btn-primary btn-sm')); ?>
                            &nbsp;&nbsp;
                            <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Delete'),
                                ['delete-mission-translations', 'id' => $m->id], array(
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

            <p><?php echo Yii::t('MissionsModule.base', 'No mission translations created yet!'); ?></p>


        <?php endif; ?>

    </div>
</div>
