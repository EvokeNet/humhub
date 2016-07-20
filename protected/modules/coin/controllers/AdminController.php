<?php

namespace humhub\modules\coin\controllers;

use Yii;
use app\modules\coin\models\Coin;
use app\modules\coin\models\Wallet;
use humhub\modules\user\models\User;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
        $wallets = Wallet::find()->all();
        $coins = Coin::find()->all();

        return $this->render('coin/index', array('wallets' => $wallets, 'coins' => $coins));
    }

    public function actionCreate()
    {
        $coin = new Coin();

        //Evoke specific code
        //TODO: make this less hacky
        $coin->name = 'EvoCoin';
        $coin->save();

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
