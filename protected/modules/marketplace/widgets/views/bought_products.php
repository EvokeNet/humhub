<div class="panel panel-defaul">
  <div class="panel-heading">
    <?php echo Yii::t('MarketplaceModule.base', 'Bought Products'); ?>
  </div>
  <div class="panel-body product-list">
    <?php if (count($unfulfilled_products) > 0): ?>
      <h6><?php echo Yii::t('MarketplaceModule.base', 'Unfulfilled Products'); ?></h6>
      <ul>
        <?php foreach($unfulfilled_products as $unfulfilled_product): ?>
          <li class="returns" id="product-<?php echo $unfulfilled_product->id ?>">
            <span><?php echo $unfulfilled_product->product->name; ?><span>
            <span><a class="return-button btn btn-success" id="return-<?php echo $unfulfilled_product->id ?>" href="#" role="button"><?php echo Yii::t('MarketplaceModule.base', 'return') ?></a></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
    <?php if (count($fulfilled_products) > 0): ?>
      <h6><?php echo Yii::t('MarketplaceModule.base', 'Fulfilled Products'); ?></h6>
      <ul>
        <?php foreach($fulfilled_products as $fulfilled_product): ?>
          <li><?php echo $fulfilled_product->product->name; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
