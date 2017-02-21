<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('AlliancesModule.base', 'Alliances');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('AlliancesModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('AlliancesModule.base', 'Team 1'); ?></th>
              <th><?php echo Yii::t('AlliancesModule.base', 'Team 2') ?></th>
              <th><?php echo Yii::t('AlliancesModule.base', 'Created At') ?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($alliances as $alliance): ?>
              <tr>
                  <!--<td><?php //echo $coin->id_code; ?></td>-->
                  <td><?php echo $alliance->team_1; ?></td>
                  <td><?php echo $alliance->team_2; ?></td>
                  <td><?php echo $alliance->created_at; ?></td>
                  <td>
                      <?php echo Html::a(
                          Yii::t('AlliancesModule.base', 'Edit'),
                          ['update', 'id' => $alliance->id], array('class' => 'btn btn-primary btn-sm')); ?>
                  </td>
                  <td>
                    <?php echo Html::a(
                        Yii::t('AlliancesModule.base', 'Delete'),
                        ['delete', 'id' => $alliance->id], array('class' => 'btn btn-alert btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
