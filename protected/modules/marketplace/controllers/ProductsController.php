<?php

namespace humhub\modules\marketplace\controllers;

use Yii;
use yii\web\Controller;
use app\modules\marketplace\models\Product;
use humhub\modules\user\models\User;
use app\models\UploadForm;
use yii\web\UploadedFile;


/**
 * AdminController
 *
 */
class ProductsController extends Controller
{
  public function actionIndex(){
    $products = Product::find()->all();

    return $this->render('index', array('products' => $products));
  }
}

?>
