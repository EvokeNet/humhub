<div class="panel panel-defaul">
  <div class="panel-heading">
    <?php echo Yii::t('MarketplaceModule.base', 'Bought Time'); ?>
  </div>
  <div class="panel-body product-list">
    <?php if (count($bought_time) > 0): ?>
      <ul>
        <?php foreach($bought_time as $unfulfilled_product): ?>

          <li class="mentor-time" id="time-<?php echo $unfulfilled_product->id ?>">
            <span><?php echo $unfulfilled_product->product->name; ?><span>
              |
            <span><?php echo $unfulfilled_product->getUserName(); ?></span>
            <span><a class="fulfill-button btn btn-success" id="fulfill-<?php echo $unfulfilled_product->id ?>" href="#" role="button"><?php echo Yii::t('MarketplaceModule.base', 'Fulfill') ?></a></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
