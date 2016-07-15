<?php

namespace humhub\modules\prize\controllers;

use Yii;
use app\modules\prize\models\Prize;

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
          if($model->save())
              return $this->redirect(['index']);
      }

      return $this->render('prize/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Wallet::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('coin/update', array('model' => $model));
    }

    public function actionCredit($id)
    {
        $model = Wallet::findOne(['id' => Yii::$app->request->get('id')]);

        return $this->render('coin/credit', array('model' => $model));
    }

    public function actionGive($id, $params = [])
    {
      echo($params);
      die();
      $model = Wallet::findOne(['id' => Yii::$app->request->get('id')]);

      $model->addCoin($credit);
      $model->save();

      return $this->redirect(['index']);
    }

    public function actionDebit($id)
    {
        $model = Wallet::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('coin/debit', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = Coin::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
}
