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

          if($model->save())
              return $this->redirect(['index']);
      }

      return $this->render('prize/create', array('model' => $model));
    }

    public function actionImburse()
    {
      $coin = Coin::find()->where(['name' => 'EvoCoin'])->one();

      $coin_id = $coin->id;
      $users = User::find()->all();

      foreach ($users as $user) {

        // check if user has wallet
        $wallet = Wallet::find()->where(['owner_id' => $user->id, 'coin_id' => $coin_id])->one();

        if (is_null($wallet)) {
          $wallet = new Wallet();

          $wallet->coin_id  = $coin_id;
          $wallet->owner_id = $user->id;
          $wallet->amount   = 0;

          $wallet->save();
        }
      }

      return $this->redirect(['index']);
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
