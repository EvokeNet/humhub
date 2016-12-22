<?php

/**
 * Events for Prize Module installation
 */

namespace humhub\modules\prize;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\coin\widget\WalletWidget;
use app\modules\coin\models\Wallet;
use app\modules\coin\models\Coin;
use humhub\modules\user\models\User;
use app\modules\teams\models\Team;
use app\modules\prize\widgets\WonPrizeWidget;

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
      'sortOrder' => 1300,
      'icon' => '<i class="fa fa-gift"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'prize' && Yii::$app->controller->action->id != 'won-prizes'
      )
    ));

    $event->sender->addItem(array(
      'label' => Yii::t('PrizeModule.base', 'Won Prizes'),
      'url' => Url::to(['/prize/admin/won-prizes']),
      'group' => 'manage',
      'sortOrder' => 1300,
      'icon' => '<i class="fa fa-gift"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'prize' && Yii::$app->controller->id == 'admin' && Yii::$app->controller->action->id == 'won-prizes'
      )
    ));
  }

  public static function onTopMenuInit($event)
  {

    $user = Yii::$app->user->getIdentity();
    $team_id = Team::getUserTeam($user->id);

    if($user->group->name != "Mentors" && $team_id){
        $event->sender->addItem(array(
            'label' => Yii::t('PrizeModule.base', 'Evoke Tools'),
            'id' => 'Evoke tools',
            'icon' => '<i class="fa fa-flask"></i>',
            'url' => Url::toRoute('/prize/evoke-tools/index'),
            'sortOrder' => 600,
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'prize' && Yii::$app->controller->id != 'admin'
            ),
        ));
    }
  }

  // show won prizes
  public static function onProfileSidebarInit($event)
  {
    $user = $event->sender->user;

    if ($user->isCurrentUser()) {
      $event->sender->addWidget(WonPrizeWidget::className(), array('user' => $user), array('sortOrder' => 20));
    }
  }

}
