<?php

/**
 * Events for Coin Module installation
 */

namespace humhub\modules\coin;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use humhub\modules\coin\widget\WalletWidget;
use app\modules\coin\models\Wallet;
use app\modules\coin\models\Coin;

/**
 * Description of Events
 */
class Events extends \yii\base\Object
{
  public static function onAdminMenuInit($event)
  {
    $event->sender->addItem(array(
      'lablel' => Yii::t('CoinModule.base', 'Coin'),
      'url' => Url::to(['/coin/admin']),
      'group' => 'manage',
      'icon' => '<i class="fa fa-coin"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'coin'
      ),
    ));
  }

  // public static function onProfileSidebarInit($event)
  // {
  //
  // }
}
