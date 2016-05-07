<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\superhero_identity;

use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use Yii;

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
