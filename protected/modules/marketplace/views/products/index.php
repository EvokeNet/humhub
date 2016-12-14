<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->pageTitle = Yii::t('MarketplaceModule.base', 'Marketplace');

?>
<div class="container">
  <div class="row">
    <div class="col-sm-8 layout-content-container">
      <div class="panel-group">
        <?php if ($user->group->name == "Mentors"):?>

          <div class="panel panel-default">
            <div class="panel-body">
              <h3>Offer your time!</h3>
            </div>
          </div>

        <?php endif; ?>
        <div class="panel panel-default">
          <div class="panel-body">

                <?php foreach ($products as $product): ?>
                  <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                      <img src='<?php echo  $product->image?>' alt="product image">
                      <div class="caption">
                        <h3><?php echo $product->name; ?></h3>
                        <p><?php echo $product->description; ?></p>
                        <p><?php echo Yii::t('MarketplaceModule.base', 'Quantity') . ': ' .  $product->quantity; ?></p>
                        <p><a href="#" class="btn btn-primary" role="button"><?php echo Yii::t('MarketplaceModule.base', 'Buy') ?></a> <?php echo $product->price; ?> evocoin</p>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>

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
