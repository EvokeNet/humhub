<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\superhero_identity;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;

/**
 * Description of Events
 *
 * @author luke
 */
class Events extends \yii\base\Object
{
    public static function onWallEntryControlsInit($event)
    {
        $object = $event->sender->object;
    }


     /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event)
    {
        // Is Module enabled on this workspace?
        $event->sender->addItem(array(
            'label' => Yii::t('SuperheroIdentityModule.base', 'Superhero Identity'),
            'id' => 'superhero_identity',
            'icon' => '<i class="fa fa-th"></i>',
            'url' => Url::toRoute('/superhero_identity/matching'),
            'sortOrder' => 100,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'superhero_identity'),
        ));
    }

    public static function onSidebarInit($event)
    {
        if (Setting::Get('enable', 'share') == 1) {
            if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
                $event->sender->addWidget(ShareWidget::className(), array(), array('sortOrder' => 150));
            }
        }
    }    
    

    /**
     * On build of a Space Navigation, check if this module is enabled.
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onSpaceMenuInit($event)
    {
        $space = $event->sender->space;

        // Is Module enabled on this workspace?
        if ($space->isModuleEnabled('superhero_identity')) {

        }
    }

    /**
     * On User delete...
     *
     * @param type $event
     */
    public static function onUserDelete($event)
    {
        return true;
    }


}
