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

        return $this->render('coin/index', array('wallets' => $wallets));
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

    public function actionUpdate($id)
    {
        $model = Wallet::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('coin/update', array('model' => $model));
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
