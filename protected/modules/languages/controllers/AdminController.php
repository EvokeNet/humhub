<?php

namespace humhub\modules\languages\controllers;

use Yii;
use app\modules\languages\models\Languages;
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
        $languages = Languages::find()->all();

        return $this->render('index', array('languages' => $languages));
    }

    public function actionCreate()
    {
      $model = new Languages();

      if ($model->load(Yii::$app->request->post())) {

      	$model->language = Yii::$app->params['availableLanguages'][$model->code];

        if($model->save())
            return $this->redirect(['index']);
      }

      return $this->render('create', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = Languages::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
    
}