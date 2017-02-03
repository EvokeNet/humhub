<?php

namespace humhub\modules\missions\widgets;

use yii;
use \yii\base\Widget;
use app\modules\coin\models\Wallet;

class GiftEvocoinWidget extends \yii\base\Widget
{

    public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $user = Yii::$app->user->getIdentity();
        $wallet = Wallet::findOne(['owner_id' => $user->id]);
        return $this->render('gift_evocoin', ['user' => $this->user, 'wallet' => $wallet]
        );

    }

}

?>