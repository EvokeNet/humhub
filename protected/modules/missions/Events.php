<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\missions;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use humhub\modules\missions\widgets\EvidenceWidget;
use humhub\modules\space\models\Space;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\ActivityPowers;
use app\modules\powers\models\UserPowers;
// use humhub\modules\dashboard\widgets\ShareWidget;

/**
 * Description of Events
 *
 */
class Events
{

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
            'label' => Yii::t('MissionsModule.base', 'Missions'),
            'id' => 'missions',
            'icon' => '<i class="fa fa-sitemap"></i>',
            'url' => Url::toRoute('/missions/missions'),
            'sortOrder' => 100,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id != 'admin'),
        ));
    }

    public static function onSidebarInit($event)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
            //$event->sender->addWidget(ShareWidget::className(), array(), array('sortOrder' => 150));
            $space = $event->sender->space;
            $event->sender->addWidget(EvidenceWidget::className(), array('space' => $space), array('sortOrder' => 9));
        }
        
    }
    
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MissionsModule.base', 'Missions'),
            'url' => Url::to(['/missions/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-sitemap"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'admin'),
        ));
    }
    
    // public static function onSpaceAdminMenuInit($event)
    // {
    //     $space = $event->sender->space;
    //     if ($space->isModuleEnabled('missions') && $space->isAdmin() && $space->isMember()) {
    //         $event->sender->addItem(array(
    //             'label' => Yii::t('MissionsModule.base', 'Missions'),
    //             'group' => 'admin',
    //             'url' => $space->createUrl('/missions/admin'),
    //             'icon' => '<i class="fa fa-th"></i>',
    //             'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'missions' && Yii::$app->controller->id == 'container' && Yii::$app->controller->action->id != 'view'),
    //         ));
    //     }
    // }


     /**
     * Create installer sample data
     * 
     * @param \yii\base\Event $event
     */
    public static function onSampleDataInstall($event)
    {
        $space = Space::find()->where(['id' => 1])->one();

        // activate module at space
        if (!$space->isModuleEnabled("missions")) {
            $space->enableModule("missions");
        }

    }

    public static function onUserLike($event){

        $evidenceModel = 'app\modules\missions\models\Evidence';

        $like = $event->action->id === 'like' ? true : false;

        $content_user_id = $event->action->controller->parentContent->content->user_id;
        $evidence = $event->action->controller->parentContent;

        //check if user isn't liking its own evidence and if it's like/unlike action and content is an evidence.
        if(($event->action->id === 'like' || $event->action->id === 'unlike') && Yii::$app->user->getIdentity()->id != $content_user_id && $event->action->controller->contentModel == $evidenceModel && isset($evidence->activities_id)){

            //ACTIVITY POWER POINTS
            $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);

            //USER POWER POINTS
            foreach($activityPowers as $activity_power){
                if(!$activity_power->flag){
                    $userPower = UserPowers::findOne(['power_id' => $activity_power->power_id, 'user_id' => $content_user_id]);
                    if($like){
                        $userPower->value += $activity_power->value;
                    }else{
                        $userPower->value -= $activity_power->value;
                    }
                    $userPower->save();
                }
            }
        }

    }

}
