<?php

namespace humhub\modules\languages;

use Yii;
use yii\helpers\Url;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('LanguagesModule.base', 'Languages'),
            'url' => Url::to(['/languages/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-gift"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'languages' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 1000,
        ));
    }
    
    public static function onSpaceAdminMenuInit($event)
    {
        $space = $event->sender->space;
        if ($space->isModuleEnabled('languages') && $space->isAdmin() && $space->isMember()) {
            $event->sender->addItem(array(
                'label' => Yii::t('LanguagesModule.base', 'Languages'),
                'group' => 'admin',
                'url' => $space->createUrl('/languages/admin'),
                'icon' => '<i class="fa fa-th"></i>',
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'languages' && Yii::$app->controller->id == 'container' && Yii::$app->controller->action->id != 'view'),
            ));
        }
    }

}
