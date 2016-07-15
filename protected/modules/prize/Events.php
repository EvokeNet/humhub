<?php

/**
 * Events for Coin Module installation
 */

namespace humhub\modules\prize;

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
      'label' => Yii::t('PrizeModule.base', 'Prizes'),
      'url' => Url::to(['/prize/admin/']),
      'group' => 'manage',
      'icon' => '<i class="fa fa-gift"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'prize'
      )
    ));
  }

  public static function onTopMenuInit($event)
  {
    if(Yii::$app->user->getIdentity()->super_admin == 1){

        $event->sender->addItem(array(
        'label' => Yii::t('PrizeModule.base', 'Evoke Tools'),
        'id' => 'Evoke tools',
        'icon' => '<i class="fa fa-flask"></i>',
        'url' => Url::toRoute('/prize/evoke-tools/index'),
        'isActive' => (
          Yii::$app->controller->module && Yii::$app->controller->module->id == 'prize' && Yii::$app->controller->id != 'admin'
         ),
        ));
    }
  }

  // public static function onProfileSidebarInit($event)
  // {
  //
  // }
}
