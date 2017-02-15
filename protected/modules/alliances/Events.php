<?php

/**
 * Events for Library Module installation
 */

namespace humhub\modules\alliances;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\teams\models\Team;
use app\modules\alliances\models\Alliance;

/**
 * Description of Events
 */
class Events extends \yii\base\Object
{
  public static function onAdminMenuInit($event)
  {
    $event->sender->addItem(array(
      'label' => Yii::t('AlliancesModule.base', 'Alliances'),
      'url' => Url::to(['/alliances/admin/']),
      'group' => 'manage',
      'sortOrder' => 1300,
      'icon' => '<i class="fa fa-handskae-o"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'alliances'
      )
    ));
  }

  public static function onSpaceMenuInit($event)
  {
    $user = Yii::$app->user->getIdentity();
    $team_id = Team::getUserTeam($user->id);
    $space = $event->sender->space;
    $has_alliance = Alliance::find()->findByTeam($team_id)->exists();

    if($space->name !="Mentors" && $has_alliance){
        $event->sender->addItem(array(
            'label' => Yii::t('AlliancesModule.event', 'Show Alliance'),
            'group' => 'modules',
            'url' => $space->createUrl('/alliances/show'),
            'icon' => '<i class="fa fa-sitemap"></i>',
            'sortOrder' => 400,
            'isActive' => (Yii::$app->controller->module
            && Yii::$app->controller->module->id == 'alliances'
            && Yii::$app->controller->id == 'alliances'),
        ));
    }
  }
}
