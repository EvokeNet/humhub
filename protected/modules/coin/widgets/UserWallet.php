<?php

namespace app\modules\coin\widgets;

use Yii;
use \yii\base\Widget;
use app\modules\coin\models\Wallet;
use app\modules\coin\models\Coin;

class UserWallet extends Widget
{


	public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      $user = Yii::$app->user->getIdentity();
      $coin_id = Coin::find()->where(['name' => 'EvoCoin'])->one()->id;
      $wallet = Wallet::find()->where(['owner_id' => $user->id, 'coin_id' => $coin_id])->one();

      return $this->render('user_wallet', array('amount' => $wallet->amount));
    }

}

?>
