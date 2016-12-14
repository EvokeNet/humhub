<?php

use yii\helpers\Html;

?>

<div class="panel panel-default">
  <div class="panel-body">
    <table class="table">
        <tr>
            <th><?php echo Yii::t('MarketplaceModule.base', 'Name'); ?></th>
            <th><?php echo Yii::t('MarketplaceModule.base', 'Quantity') ?></th>
            <th><?php echo Yii::t('MarketplaceModule.base', 'Price') ?></th>
            <th><?php echo Yii::t('MarketplaceModule.base', 'Description') ?></th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <!--<td><?php //echo $coin->id_code; ?></td>-->
                <td><?php echo $product->name; ?></td>
                <td><?php echo $product->quantity; ?></td>
                <td><?php echo $product->price; ?></td>
                <td><?php echo $product->description; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
  </div>
</div>
