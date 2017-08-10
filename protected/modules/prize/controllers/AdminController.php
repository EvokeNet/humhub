<?php

namespace humhub\modules\prize\controllers;

use Yii;
use app\modules\prize\models\Prize;
use app\modules\prize\models\WonPrize;
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
        $prizes = Prize::find()->all();

        return $this->render('prize/index', array('prizes' => $prizes));
    }

    public function actionCreate()
    {
      $model = new Prize();

      if ($model->load(Yii::$app->request->post())) {
        $uploadedFile = UploadedFile::getInstance($model, 'image');

        // only upload a file if it was attached
        if ($uploadedFile !== null) {
          $model->image = UploadedFile::getInstance($model, 'image');
          $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
          $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;
        }

        $model->created_at = date("Y-m-d H:i:s");

        if($model->save())
            return $this->redirect(['index']);
      }

      return $this->render('prize/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Prize::findOne(['id' => Yii::$app->request->get('id')]);
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

        return $this->render('prize/update', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = Prize::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionWonPrizes() {
      $won_prizes = WonPrize::find()->all();

      return $this->render('won-prize/index', array('won_prizes' => $won_prizes));
    }
}
