<div class="panel panel-defaul">
  <div class="panel-heading">
    <?php echo Yii::t('MarketplaceModule.base', 'Bought Products'); ?>
  </div>
  <div class="panel-body">
    <?php if (count($fulfilled_products) > 0): ?>
      <h6><?php echo Yii::t('MarketplaceModule.base', 'Fulfilled Product'); ?></h6>
      <ul>
        <?php foreach($fulfilled_products as $product): ?>
          <li><?php echo $product->name; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php if (count($unfulfilled_products) > 0): ?>
      <h6><?php echo Yii::t('MarketplaceModule.base', 'Unfulfilled Product'); ?></h6>
      <ul>
        <?php foreach($unfulfilled_products as $product): ?>
          <li class="returns" id="product-<?php echo $product->id ?>">
            <span><?php echo $product->name; ?><span>
            <span><a class="return-button btn btn-success" id="return-<?php echo $product->id ?>" href="#" role="button"><?php echo Yii::t('MarketplaceModule.base', 'return') ?></a></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
