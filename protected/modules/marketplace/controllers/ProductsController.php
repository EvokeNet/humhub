<?php

namespace humhub\modules\marketplace\controllers;

use Yii;
use yii\web\Controller;
use app\modules\marketplace\models\Product;
use humhub\modules\user\models\User;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\modules\coin\models\Coin;
use app\modules\coin\models\Wallet;


/**
 * AdminController
 *
 */
class ProductsController extends Controller
{
  public function actionIndex(){
    $user = Yii::$app->user->getIdentity();
    $products = Product::find()->all();
    $coin_id = Coin::find()->where(['name' => 'EvoCoin'])->one()->id;
    $wallet = Wallet::find()->where(['owner_id' => $user->id, 'coin_id' => $coin_id])->one();

    return $this->render('index', array('products' => $products, 'wallet' => $wallet, 'user' => $user));
  }
}

?>
