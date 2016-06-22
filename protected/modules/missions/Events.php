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
use humhub\modules\missions\widgets\PopUpWidget;
use humhub\modules\space\models\Space;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\ActivityPowers;
use app\modules\powers\models\UserPowers;
use humhub\modules\user\models\User;
// use humhub\modules\dashboard\widgets\ShareWidget;

/**
 * Description of Events
 *
 */
class Events
{

    public static function onDashboardSidebarInit($event){
        $event->sender->addWidget(PopUpWidget::className(), []);
    }

    public static function onSidebarInit($event)
    {
        
        if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
            $space = $event->sender->space;
            $event->sender->addWidget(PopUpWidget::className(), []);
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
                    $user = User::findOne($content_user_id);
                    if($like){
                        UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
                    }else{
                        UserPowers::addPowerPoint($activity_power->getPower(), $user, - $activity_power->value);
                    }
                }
            }
        }

    }

}
