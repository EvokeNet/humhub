<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\powers;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use humhub\modules\powers\widgets\UserPowersWidget;
use app\modules\powers\models\UserPowers;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('PowersModule.base', 'Powers'),
            'url' => Url::to(['/powers/admin']),
            'group' => 'manage',
            'sortOrder' => 900,
            'icon' => '<i class="fa fa-bolt"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'powers'
            ),
        ));
    }

    public static function onProfileSidebarInit($event)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
            /*
            $qualities = UserPowers::getUserPowers($event->sender->user->id);

            foreach($qualities as $quality_powers){
                $event->sender->addWidget(UserPowersWidget::className(), array('powers' => $quality_powers), array('sortOrder' => 9));
            }
            */
        }
        
    }

}
