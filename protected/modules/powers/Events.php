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
            'icon' => '<i class="fa fa-bolt"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'powers'
            ),
        ));
    }
}
