<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MarketplaceModule.base', 'Bought Products');
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
              <th><?php echo Yii::t('MarketplaceModule.base', 'User'); ?></th>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Product') ?></th>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Fulfilled?') ?></th>
              <th><?php echo Yii::t('MarketplaceModule.base', 'Click to mark as fulfilled') ?></th>
          </tr>
          <?php foreach ($bought_products as $bought_product): ?>
              <tr>


                  <td><?php echo $bought_product->getUserName(); ?></td>
                  <td><?php echo $bought_product->getProductName(); ?></td>
                  <td id='fulfilled<?php echo $bought_product->id?>'><?php echo $bought_product->fulfilled ? Yii::t('MarketplaceModule.base', 'Yes') : Yii::t('MarketplaceModule.base', 'No'); ?></td>
                  <td><a class="fulfill-button btn btn-warning" id="boughtProduct-<?php echo $bought_product->id ?>" href="#" role="button" data-fulfill='1'><?php echo Yii::t('MarketplaceModule.base', 'Fulfill') ?></a> | <a class="fulfill-button btn btn-default" id="boughtProduct-<?php echo $bought_product->id ?>" href="#" role="button" data-fulfill = '0'><?php echo Yii::t('MarketplaceModule.base', 'Unfulfill') ?></a></td>
              </tr>
          <?php endforeach; ?>
      </table>
    </div>
</div>

<script>
  $('.fulfill-button').on('click', function(e){
    e.preventDefault();
    $target = $(e.target);
    var boughtProductID  = $target.attr('id').replace('boughtProduct-', ''),
        fulfill = $target.data('fulfill');

    $.ajax({
        url: 'index.php?r=marketplace%2Fadmin%2Ffulfill&bought_product_id='+boughtProductID+'&fulfill='+fulfill,
        type: 'get',
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            if (parseInt(response.fulfilled)) {
              $('#fulfilled' + boughtProductID).text(' <?php echo Yii::t("MarketplaceModule.base", "Yes"); ?>');
            } else {
              $('#fulfilled' + boughtProductID).text(' <?php echo Yii::t("MarketplaceModule.base", "No"); ?>');
            }
          } else {
            //didnt' work
          }
        }
    });
  });
</script>
