<?php

/**
 * Events for Library Module installation
 */

namespace humhub\modules\library;

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
      'label' => Yii::t('LibraryModule.base', 'Library'),
      'url' => Url::to(['/library/admin/']),
      'group' => 'manage',
      'sortOrder' => 1300,
      'icon' => '<i class="fa fa-mortar-board"></i>',
      'isActive' => (
        Yii::$app->controller->module && Yii::$app->controller->module->id == 'library'
      )
    ));
  }

  public static function onTopMenuInit($event)
  {

    $event->sender->addItem(array(
        'label' => Yii::t('LibraryModule.base', 'Library'),
        'id' => 'Evoke tools',
        'icon' => '<i class="fa fa-mortar-board"></i>',
        'url' => Url::toRoute('/library/library/index'),
        'sortOrder' => 600,
        'isActive' => (
            Yii::$app->controller->module && Yii::$app->controller->module->id == 'library' && Yii::$app->controller->id != 'admin'
        ),
    ));

  }

}
