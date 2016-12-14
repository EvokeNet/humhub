<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->pageTitle = Yii::t('MarketplaceModule.base', 'Marketplace');

?>
<div class="container">
  <div class="row">
    <div class="col-sm-8 layout-content-container">
      <div class="panel-group">
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
      </div>
    </div>
    <div class="col-sm-4 layout-sidebar-container">
      <div class="panel panel-default">
          <div class="panel-heading">
              <strong><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></strong>
          </div>
          <div class="panel-body text-center">
              <div class = "evocoins">
                  <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>">
                  <div><p id="userEvocoins"><?= $wallet->amount ?></p></div>
              </div>
              <br>
              <p style = "font-size:9pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>
          </div>
      </div>
        <?php
        echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
        ]]);
        ?>
    </div>
  </div>
</div>
