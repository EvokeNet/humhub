<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('StatsModule.base', 'Evocoin Statistics');
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
    <h4><?php echo Yii::t('StatsModule.base', 'Evocoins'); ?></h4></br>
    <ul>
        <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total Number of Evocoins: {list}', array('list' => $total_coin)); ?></span></li>
        <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Total Number of Evocoins Created: {list}', array('list' => $total_coin_created)); ?></span></li>
        <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Evocoin from Reviews: {list}', array('list' => $evocoin_from_reviews)); ?></span></li>
        <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Evocoin from Comments: {list}', array('list' => $evocoin_from_comments)); ?></span></li>
    </ul>
    </br>
    <h4><?php echo Yii::t('StatsModule.base', 'Slot Machine'); ?></h4></br>
    <ul>
      <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Slot Machine Uses: {list}', array('list' => $slot_machine_stats->uses)); ?></span></li>
      <li><span style="font-size:13pt"><?php echo Yii::t('StatsModule.base', 'Slot Machine Evocoin Created: {list}', array('list' => $slot_machine_stats->evocoin_created)); ?></span></li>
    </ul>
  </div>
</div>
