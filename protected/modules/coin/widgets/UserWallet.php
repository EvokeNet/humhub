<?php

namespace humhub\modules\coin\widgets;

use \yii\base\Widget;
use app\modules\coin\models\Wallet;

class UserWallet extends Widget
{


	public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      $wallet = Wallet::findOne(['owner_id' => $this->user->id]);

      return $this->render('user_wallet', array('amount' => $wallet->amount));
    }

}

?>
