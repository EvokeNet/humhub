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
            <div class="panel-heading">
              <h4><?php echo Yii::t('MarketplaceModule.base', 'Offer your time!'); ?></h3>
            </div>
            <div class="panel-body">
              <p>
                <?php echo Yii::t('MarketplaceModule.base', 'As a mentor you can offer your time to the agents to help with their projects, activities, or offer guidance.'); ?>
              </p>
              <?php echo Html::a(Yii::t('MarketplaceModule.base', 'Offer your time'), ['mentoring'], array('class' => 'btn btn-primary')); ?>
            </div>
          </div>

        <?php endif; ?>
        <div class="panel panel-default">
          <div class="panel-body">

                <?php foreach ($products as $index=>$product): ?>
                  <?php if ($index == 0): ?>
                    <div class="row is-flex">
                  <?php elseif (($index % 3) == 0): ?>
                    </div>
                    <div class="row is-flex">
                  <?php endif; ?>

                  <?php
                    if ($product->quantity < 1) {
                      $is_sold_out = ' sold-out';
                    } else {
                      $is_sold_out = '';
                    }
                  ?>

                  <div class="col-sm-6 col-md-4 product-containe">
                    <div class='thumbnail product<?php echo $is_sold_out ?>'>
                      <div class="product-image" style="background-image: url('<?php echo  $product->image?>')"></div>
                      <div class="caption">
                        <h3 class="product-name"><?php echo $product->name; ?></h3>
                        <p><?php echo $product->description; ?></p>
                        <p><?php echo Yii::t('MarketplaceModule.base', 'Quantity') . ': '; ?><span id='<?php echo "product" . $product->id . "Quantity" ?>'><?php echo $product->quantity; ?></span></p>
                      </div>
                      <?php if($product->quantity >= 1): ?>
                        <div id='purchaseProduct<?php echo $product->id ?>' class="purchase"><a class="buy-button btn btn-success" id="buy-<?php echo $product->id ?>" href="#" role="button"><?php echo Yii::t('MarketplaceModule.base', 'Buy') ?></a> <?php echo $product->price . ' ' . Yii::t('MarketplaceModule.base', 'Evocoin(s)'); ?></div>
                      <?php else: ?>
                        <p><?php echo Yii::t('MarketplaceModule.base', 'Sold Out'); ?></p>
                      <?php endif; ?>
                    </div>
                  </div>
                  <?php if ($index == (count($products) - 1)): ?>
                    </div>
                  <?php endif; ?>
                <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4 layout-sidebar-container">
      <?php echo \app\modules\coin\widgets\UserWallet::widget() ?>
      <?php
      echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
              [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
      ]]);
      ?>
    </div>
  </div>
</div>
