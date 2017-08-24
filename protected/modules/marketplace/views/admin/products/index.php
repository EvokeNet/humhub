<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MarketplaceModule.base', 'Products');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo $this->title; ?></h3>
        <?php echo Html::a(Yii::t('MarketplaceModule.base', 'Create'), ['create'], array('class' => 'btn btn-success')); ?>
    </div>
    <div class="panel-body">
      <table class="table">
          <tr>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Name'); ?></th>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Quantity') ?></th>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Price') ?></th>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Description') ?></th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
          </tr>
          <?php foreach ($products as $product): ?>
              <tr>
                  <!--<td><?php //echo $coin->id_code; ?></td>-->
                  <td><?php echo $product->name; ?></td>
                  <td><?php echo $product->quantity; ?></td>
                  <td><?php echo $product->price; ?></td>
                  <td><?php echo $product->description; ?></td>
                  <td>
                      <?php echo Html::a(
                          Yii::t('MarketplaceModule.base', 'Edit'),
                          ['update', 'id' => $product->id], array('class' => 'btn btn-primary btn-sm')); ?>
                  </td>
                  <td>
                    <?php echo Html::a(
                        Yii::t('MarketplaceModule.base', 'Delete'),
                        ['delete', 'id' => $product->id], array('class' => 'btn btn-alert btn-sm')); ?>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>
