<?php

/**
 * Events for Marketplace Module installation
 */

namespace humhub\modules\marketplace;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\coin\widget\WalletWidget;
use app\modules\coin\models\Wallet;
use app\modules\coin\models\Coin;
use humhub\modules\user\models\User;
use app\modules\teams\models\Team;
use app\modules\marketplace\widgets\BoughtProductsWidget;
use app\modules\marketplace\widgets\BoughtTimeWidget;


/**
 * Description of Events
 */
class Events extends \yii\base\Object
{
  public static function onAdminMenuInit($event)
  {
    $event->sender->addItem(array(
      'label' => Yii::t('MarketplaceModule.base', 'Marketplace'),
      'url' => Url::to(['/marketplace/admin/']),
      'group' => 'manage',
      'sortOrder' => 1300,
      'icon' => '<i class="fa fa-shopping-cart"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'marketplace' && Yii::$app->controller->action->id != 'bought-products'
      )
    ));
    $event->sender->addItem(array(
      'label' => Yii::t('MarketplaceModule.base', 'Bought Products'),
      'url' => Url::to(['/marketplace/admin/bought-products']),
      'group' => 'manage',
      'sortOrder' => 1300,
      'icon' => '<i class="fa fa-shopping-cart"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'marketplace' && Yii::$app->controller->action->id == 'bought-products'
      )
    ));
  }

  public static function onTopMenuInit($event)
  {

    $event->sender->addItem(array(
        'label' => Yii::t('MarketplaceModule.base', 'Marketplace'),
        'id' => 'Evoke tools',
        'icon' => '<i class="fa fa-shopping-cart"></i>',
        'url' => Url::toRoute('/marketplace/products/index'),
        'sortOrder' => 600,
        'isActive' => (
            Yii::$app->controller->module && Yii::$app->controller->module->id == 'marketplace' && Yii::$app->controller->id != 'admin'
        ),
    ));

  }

  // show bought products
  public static function onProfileSidebarInit($event)
  {
    $user = $event->sender->user;

    if ($user->isCurrentUser()) {
      $event->sender->addWidget(BoughtProductsWidget::className(), array('user' => $user), array('sortOrder' => 20));

      // show mentors their time that has been bought
      if ($user->group->name == "Mentors") {
        $event->sender->addWidget(BoughtTimeWidget::className(), array('user' => $user), array('sortOrder' => 19));
      }
    }
  }

}
