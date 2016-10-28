<?php

namespace humhub\modules\achievements;

use Yii;
use yii\helpers\Url;
use app\modules\missions\models\Evidence;
use app\modules\achievements\models\Achievements;
use app\modules\achievements\models\UserAchievements;
use humhub\modules\missions\controllers\AlertController;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{

    public static function onEvidenceAfterSave($event){

        //get user id (evidence's author)
        $user_id = $event->sender->created_by;

        //get user's evidence count
        $evidences_count = Evidence::find()
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `evidence`.`id` = `c`.`object_id`')
        ->where(['evidence.created_by' => $user_id])
        ->andWhere(['visibility' => 1])
        ->count();

        // get latest evidence's achievement
        $latest_achievement = (new \yii\db\Query())
                    ->select(['SUBSTRING(a.code, 10) * 1 as evidence_number'])
                    ->from('user_achievements as ua')
                    ->join('INNER JOIN', 'achievements as a', '`a`.`id` = `ua`.`achievement_id`')
                    ->where('ua.user_id = '.$user_id." AND a.code like 'evidence%'")
                    ->orderBy('evidence_number desc')
                    ->one()['evidence_number'];

        //if no achievements yet
        $latest_achievement = $latest_achievement ? $latest_achievement : 0;

        /* 
        *   Loop starting at 6 (smaller achievement) if there's no reached achievement yet or next possible achievement (current highest * 2)
        *
        *   Code example:
        *   User submitted total 24 evidences and latest achievement is evidence_12
        *   max(6, 12*2) = 24
        *   loop starts at 24
        *   User's total evidences >= 24? Yes, then create new user achievement
        *   next iteration: $x*=2, then 24*=2 equals 48
        *   User's total evidences >= 48? No, then loop is ended
        */

        for($x = max(6, $latest_achievement * 2); $x <= 48; $x*=2){

            //evidence count is higher or equal achievement requirement?
            if($evidences_count >= $x){
                // find achievement
                $achievement = Achievements::findOne(['code' => 'evidence_'.$x]);

                if($achievement){
                    //create new user achievement
                    $user_achievement = new UserAchievements();
                    $user_achievement->achievement_id = $achievement->id;
                    $user_achievement->user_id = $user_id;
                    $user_achievement->save();

                    AlertController::createAlert("Congratulations", $achievement->title." <div><i style=\"font-size: 60px; padding-top: 20px;\" class=\"fa fa-trophy\" aria-hidden=\"true\"></i></div>");
                }

            }else{
                //jump out of loop because user hasn't any new achievements
                break;
            }
        }

    }

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('AchievementsModule.base', 'Achievements'),
            'url' => Url::to(['/achievements/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-th"></i>',
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'achievements' && Yii::$app->controller->id == 'admin'),
            'sortOrder' => 300,
        ));
    }
    
    public static function onSpaceAdminMenuInit($event)
    {
        $space = $event->sender->space;
        if ($space->isModuleEnabled('achievements') && $space->isAdmin() && $space->isMember()) {
            $event->sender->addItem(array(
                'label' => Yii::t('AchievementsModule.base', 'Achievements'),
                'group' => 'admin',
                'url' => $space->createUrl('/achievements/admin'),
                'icon' => '<i class="fa fa-th"></i>',
                'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'achievements' && Yii::$app->controller->id == 'container' && Yii::$app->controller->action->id != 'view'),
            ));
        }
    }

    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event){
        $event->sender->addItem(array(
        'label' => Yii::t('AchievementsModule.event', 'Achievements'),
        'id' => 'achievements',
        'icon' => '<i class="fa fa-trophy" aria-hidden="true"></i>',
        'url' => Url::to(['/achievements/achievements/index']),
        'sortOrder' => 700,
        'isActive' => (Yii::$app->controller->module
            && Yii::$app->controller->module->id == 'achievements'
            && Yii::$app->controller->id == 'achievements'),
        ));
    }

}
