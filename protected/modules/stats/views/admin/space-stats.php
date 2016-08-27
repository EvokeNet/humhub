<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('StatsModule.base', 'Space Statistics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('StatsModule.base', 'Statistics Reports'), 'url' => ['index']];
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
        
        <table class="table">
            <tr>
                <th><?php echo Yii::t('StatsModule.base', 'Name'); ?></th>
                <!--<th><?php //echo Yii::t('StatsModule.base', 'Username'); ?></th>-->
                <th><?php echo Yii::t('StatsModule.base', 'Total Users on each team'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Evidences Submitted by team'); ?></th>
                <th><?php echo Yii::t('StatsModule.base', 'Total reviews by team'); ?></th>
            </tr>
            <?php foreach ($spaces as $space): ?>
                <tr>
                    <td><?php echo $space['name']; ?></td>
                    <td><?php echo $space['members']; ?></td>
                    <td><?php echo $space['evidences']; ?></td>
                    <td><?php echo $space['reviews']; ?></td>
                    <!--<td><?php //echo $mission->description; ?></td>-->
                </tr>
            <?php endforeach; ?>
        </table>
        
    </div>
</div>