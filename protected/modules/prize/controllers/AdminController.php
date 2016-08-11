<?php

namespace humhub\modules\prize\controllers;

use Yii;
use app\modules\prize\models\Prize;
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
          $model->created_at = date("Y-m-d H:i:s");
          $model->image = UploadedFile::getInstance($model, 'image');
          $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
          $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;

          if($model->save())
              return $this->redirect(['index']);
      }

      return $this->render('prize/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Prize::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post())) {
          $model->created_at = date("Y-m-d H:i:s");
          $model->image = UploadedFile::getInstance($model, 'image');
          $model->image->saveAs('uploads/' . $model->image->baseName . '.' . $model->image->extension);
          $model->image = 'uploads/' . $model->image->baseName . '.' . $model->image->extension;

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
}
