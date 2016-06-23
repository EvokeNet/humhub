<?php

namespace humhub\modules\coin\controllers;

use Yii;
use app\modules\coin\models\Coin;
use app\modules\coin\models\Wallet;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
        $coins = Coin::find()->all();

        return $this->render('coin/index', array('coins' => $coins));
    }

    public function actionCreate()
    {
        $model = new Coin();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('coin/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Coin::findOne(['id' => Yii::$app->request->get('id')]);

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

    public function actionWallet()
    {
      $wallets = Wallet::find()->all();
      return $this->render('wallet/index', array('wallets' => $wallets));
    }
}
