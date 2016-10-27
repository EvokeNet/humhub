<?php

namespace humhub\modules\achievements;

use Yii;
use yii\helpers\Url;
use app\modules\missions\models\Evidence;
use app\modules\achievements\models\UserAchievements;

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
                    ->select('')
                    ->from('user_achivements as ua')
                    ->join('INNER JOIN', 'achievements as a', '`a`.`id` = `ua`.`achievement_id`')
                    ->where('ua.user_id = '.$user_id." AND a.code like \'%evidence%\'")
                    ->one()['count'];

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

}
