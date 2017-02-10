<?php

/**
 * Events for Library Module installation
 */

namespace humhub\modules\alliances;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;

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
}
