<?php

/**
 * Events for Coin Module installation
 */

namespace humhub\modules\coin;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\coin\widget\WalletWidget;
use app\modules\coin\models\Wallet;
use app\modules\coin\models\Coin;
use humhub\modules\user\models\User;

/**
 * Description of Events
 */
class Events extends \yii\base\Object
{
  public static function onAdminMenuInit($event)
  {
    $event->sender->addItem(array(
      'label' => Yii::t('CoinModule.base', 'Wallet'),
      'url' => Url::to(['/coin/admin/']),
      'group' => 'manage',
      'sortOrder' => 1200,
      'icon' => '<i class="fa fa-money"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'coin'
      )
    ));
  }

  public static function onAuthUser($event){

    //on login and create account actions
    if(property_exists($event->action, "actionMethod") && (($event->action->actionMethod) && $event->action->actionMethod === 'actionLogin' || $event->action->actionMethod === 'actionCreateAccount')){

      //Check if user is logged in
      if(null != Yii::$app->user->getIdentity()){
        //make sure they have a wallet
        $user = Yii::$app->user->getIdentity();
        $coin = Coin::find()->where(['name' => 'EvoCoin'])->one();

        if (!isset($coin)) {
          //nothing to be done
          return;
        }

        $coin_id = $coin->id;
        $wallet = Wallet::find()->where(['owner_id' => $user->id, 'coin_id' => $coin_id])->one();

        //give them a wallet if they have none
        if (is_null($wallet)) {
          $wallet = new Wallet();

          $wallet->coin_id  = $coin_id;
          $wallet->owner_id = $user->id;
          $wallet->amount   = 0;

          $wallet->save();
        }
      }
    }
  }
}
