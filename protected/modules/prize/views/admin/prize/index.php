<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('PrizeModule.base', 'Prizes');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('PrizeModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('PrizeModule.base', 'Name'); ?></th>
              <th><?php echo Yii::t('PrizeModule.base', 'Quantity') ?></th>
              <th><?php echo Yii::t('PrizeModule.base', 'Weight') ?></th>
              <th><?php echo Yii::t('PrizeModule.base', 'Week of') ?></th>
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($prizes as $prize): ?>
              <tr>
                  <!--<td><?php //echo $coin->id_code; ?></td>-->
                  <td><?php echo $prize->name; ?></td>
                  <td><?php echo $prize->quantity; ?></td>
                  <td><?php echo $prize->weight; ?></td>
                  <td><?php echo $prize->week_of; ?></td>
                  <td>
                      <?php echo Html::a(
                          Yii::t('PrizeModule.base', 'Edit'),
                          ['update', 'id' => $prize->id], array('class' => 'btn btn-primary btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
