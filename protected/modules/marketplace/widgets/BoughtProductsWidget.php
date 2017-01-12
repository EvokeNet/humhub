<?php

namespace app\modules\marketplace\widgets;

use \yii\base\Widget;
use app\modules\marketplace\models\BoughtProduct;
use app\modules\marketplace\models\Product;

class BoughtProductsWidget extends \yii\base\Widget
{
  public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      $bought_product_records = BoughtProduct::find()->select('product_id')->where(['user_id' => $this->user->id])->all();
      $fulfilled_products = [];
      $unfulfilled_products = [];

      foreach($bought_product_records as $bought_product_record) {
        if ($bought_product_record->fulfilled == true) {
          $product = Product::find()->where(['id' => $bought_product_record->product_id])->one();
          $fulfilled_products[] = $product;
        } else {
          $product = Product::find()->where(['id' => $bought_product_record->product_id])->one();
          $unfulfilled_products[] = $product;
        }

      }

        return $this->render('bought_products', array('fulfilled_products' => $fulfilled_products,
                                                      'unfulfilled_products' => $unfulfilled_products));
    }

}

?>
