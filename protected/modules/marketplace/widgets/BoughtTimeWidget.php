<?php

namespace app\modules\marketplace\widgets;

use \yii\base\Widget;
use app\modules\marketplace\models\BoughtProduct;
use app\modules\marketplace\models\Product;

class BoughtTimeWidget extends \yii\base\Widget
{
  public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      $offered_time = Product::find()->where(['seller_id' => $this->user->id])->all();
      $bought_time = [];

      foreach ($offered_time as $product) {
        $bought_products = BoughtProduct::find()->where(['product_id' => $product->id, 'fulfilled' => 0])->all();
        foreach ($bought_products as $bought_product) {
          $bought_time[] = $bought_product;
        }
      }

      return $this->render('bought_time', array('bought_time' => $bought_time));
    }

}

?>
