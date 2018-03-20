<?php

namespace humhub\modules\library\controllers;

use Yii;
use app\modules\library\models\LibraryResource;
use humhub\modules\user\models\User;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
        $library_resources = LibraryResource::find()->orderBy('name ASC')->all();

        return $this->render('library_resources/index', array('library_resources' => $library_resources));
    }

    public function actionCreate()
    {
      $model = new LibraryResource();

      if ($model->load(Yii::$app->request->post())) {

        $model->created_at = date("Y-m-d H:i:s");

        if($model->save())
            return $this->redirect(['index']);
      }

      return $this->render('library_resources/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = LibraryResource::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post())) {

          if ($model->save()) {
            return $this->redirect(['index']);
          }
        }

        return $this->render('library_resources/update', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = LibraryResource::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
}
