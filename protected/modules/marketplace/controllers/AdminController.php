<?php

namespace humhub\modules\marketplace\controllers;

use Yii;
use app\modules\marketplace\models\Product;
use app\modules\marketplace\models\BoughtProduct;
use humhub\modules\user\models\User;
use app\models\UploadForm;
use yii\web\UploadedFile;


/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
        $products = Product::find()->all();

        return $this->render('products/index', array('products' => $products));
    }

    public function actionCreate()
    {
      $model = new Product();

      if ($model->load(Yii::$app->request->post())) {
        $uploadedFile = UploadedFile::getInstance($model, 'image');

        // only upload a file if it was attached
        if ($uploadedFile !== null) {
          $model->image = UploadedFile::getInstance($model, 'image');
          $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
          $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;
        }

        $model->created_at = date("Y-m-d H:i:s");
        $model->seller_id = -1;

        if($model->save())
            return $this->redirect(['index']);
      }

      return $this->render('products/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Product::findOne(['id' => Yii::$app->request->get('id')]);
        $old_image = $model->image;

        if ($model->load(Yii::$app->request->post())) {
          $uploadedFile = UploadedFile::getInstance($model, 'image');

          // only upload a file if it was attached
          if ($uploadedFile !== null) {
            $model->image = UploadedFile::getInstance($model, 'image');
            $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
            $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;
          } else {
            $model->image = $old_image;
          }

          if ($model->save()) {
            return $this->redirect(['index']);
          }
        }

        return $this->render('products/update', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = Product::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionBoughtProducts() {
      $bought_products = BoughtProduct::find()
                         ->joinWith('product')
                         ->where(['products.seller_id' => -1])
                         ->all();

      return $this->render('bought_products/index', array('bought_products' => $bought_products));
    }

    public function actionFulfill() {
      $bought_product_id = Yii::$app->request->get('bought_product_id');
      $fulfill = Yii::$app->request->get('fulfill');

      $bought_product = BoughtProduct::findOne(['id' => $bought_product_id]);

      $bought_product->fulfilled = $fulfill;
      $response = ['fulfilled' => $fulfill];

      if ($bought_product->save()) {
        $response['success'] = true;
      } else {
        $response['success'] = false;
      }
      return json_encode($response);
    }
}
