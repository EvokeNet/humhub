<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;
use app\modules\teams\models\Team;
use app\modules\missions\models\Missions;
use app\modules\missions\models\EvokationDeadline;
use app\modules\missions\models\forms\EvokeSettingsForm;
use humhub\models\Setting;

class DashboardMissionProgressIndicator extends \yii\base\Widget
{


    /**
     * @inheritdoc
     */
    public function run()
    {
        //$progress = DashboardMissionProgressIndicator::getProgress();

        //print_r($progress);   

        $user = Yii::$app->user->getIdentity();

        //$mission_progress = array();
        //$mission_total = array();

        // get latest mission id
        $mission_progress = DashboardMissionProgressIndicator::getProgress();
        // get position
        $mission_progress = Missions::findOne($mission_progress)->position;

        // $mission_total = Missions::find()
        //                 ->where(['missions.locked' => 0])
        //                 ->count();

        $activities_completed = 0;
        $total_activities = 0;
        $missing_activities = 0;

         $missions = Missions::find()
         ->with(['activities', 'activities.evidences', 'activities.activityPowers'])
         ->where(['missions.locked' => 0])
         ->orderBy('missions.position ASC')
         ->all();

         $i = 0;

         foreach($missions as $m):
            $i = $m->position;
            $stats = DashboardMissionProgressIndicator::getMissionStats($m->id);

            if($i <= $mission_progress + 1 || ($i == 1 && $mission_progress == -1)){
                $activities_completed += $stats['total_evidences'];

                if($i == ($mission_progress + 1)  || ($i == 1 && $mission_progress == -1)){
                    $missing_activities = $stats['total_activities'] - $stats['total_evidences'];
                }
            }

             $total_activities += $stats['total_activities'];

        endforeach;

        //add evokation to counter
        $total_activities++;
        //verify evokation
        $evokation = DashboardMissionProgressIndicator::getEvokationCompletion();
        if($evokation){
            $activities_completed++;
        }

        $evokation_deadline = EvokationDeadline::getEvokationDeadline();
        $enabled_evokations = Setting::Get('enabled_evokations');
        //$will_start_in_one_week = $enabled_evokations && $evokation_deadline->willStartIn(7)? 1 : 0;

        return $this->render('dashboard_mission_progress_indicator', array('missions' => $missions, 
            'missing_activities' => $missing_activities, 
            'latest_completed_mission' => $mission_progress, 
            'total_activities' => $total_activities, 
            'activities_completed' => $activities_completed, 
            //'will_start_in_one_week' => $will_start_in_one_week, 
            'evokation_deadline' => $evokation_deadline));
    }

    public static function getEvokationCompletion(){
        $user = Yii::$app->user->getIdentity();
        $team_id = Team::getUserTeam($user->id);

        $evokation = (new \yii\db\Query())
            ->select(['count(e.id) as evokations'])
            ->from('evokations as e')
            ->join('INNER JOIN', 'user as u', 'u.id = `e`.`created_by`')
            ->join('INNER JOIN', 'space_membership as sm', 'sm.user_id = `u`.`id`')
            ->where('sm.space_id = '.$team_id)
            ->one()['evokations'];

        return $evokation;
    }

    public static function getMissionIds()
    {
        return (new \yii\db\Query())
            ->select(['m.id'])
            ->from('missions as m')
            ->where(['m.locked' => 0])
            ->orderBy('m.position ASC')
            ->all();
    }

    public static function getProgress()
    {
        $progress = -1;
        $mission_ids = DashboardMissionProgressIndicator::getMissionIds();

        foreach($mission_ids as $mission_id){
            $completion = DashboardMissionProgressIndicator::getMissionCompletion($mission_id['id']);           
            if($completion){
                $progress = $mission_id['id'];
            }else{
                break;
            }
        }

        return $progress;
    }

    public static function getMissionCompletion($mission_id){
        $stats = DashboardMissionProgressIndicator::getMissionStats($mission_id);
        return ($stats['total_activities'] == $stats['total_evidences']) ? true : false;
    }

    public static function getQueryTotal($query){
        $total = 0;
        foreach($query as $value){
            if($value >= 1){
                $total++;
            }
        }
        return $total;
    }

    public static function getMissionStats($mission_id)
    {
        $user = Yii::$app->user->getIdentity();

        $total_activities = (new \yii\db\Query())
            ->select(['count(a.id) as total_activities'])
            ->from('activities as a')
            ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
            ->where(['m.id' => $mission_id])
            ->one()['total_activities'];

        //get votes per evidence   
        $total_evidences = (new \yii\db\Query())
            ->select(['count(e.id) as total_evidences'])
            ->from('activities as a')
            ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
            ->join('LEFT JOIN', 'evidence as e', 'e.activities_id = `a`.`id` and e.created_by = '.$user->id)
            ->join('LEFT JOIN', 'content as c', 'c.object_id = `e`.`id` and c.object_model like "%Evidence%"')
            ->join('INNER JOIN', 'votes as v', 'v.evidence_id = `e`.`id` and v.user_type = "Mentors"')
            ->where(['m.id' => $mission_id, 'c.visibility' => 1, 'm.locked' => 0])
            ->andWhere('a.is_group = 0 OR a.is_group is null')
            ->groupBy('e.id')
            ->all();

        //get total
        $total_evidences = DashboardMissionProgressIndicator::getQueryTotal($total_evidences);

        $total_evidences_group_activity = 0;

        //check group activity

        $total_group_activities = (new \yii\db\Query())
            ->select(['count(a.id) as total_activities'])
            ->from('activities as a')
            ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
            ->where(['m.id' => $mission_id, 'a.is_group' => 1,'m.locked' => 0])
            ->one()['total_activities'];

        //get votes per activity evidence  
        if($total_group_activities >= 1){
            $team_id = Team::getUserTeam($user->id);

            $total_evidences_group_activity  = (new \yii\db\Query())
            ->select(['count(e.id) as total_evidences'])
            ->from('activities as a')
            ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
            ->join('LEFT JOIN', 'evidence as e', 'e.activities_id = `a`.`id`')
            ->join('LEFT JOIN', 'content as c', 'c.object_id = `e`.`id` and c.object_model like "%Evidence%"')
            ->join('LEFT JOIN', 'user as u', 'e.created_by = `u`.`id`')
            ->join('LEFT JOIN', 'space_membership as sm', 'sm.user_id = `u`.`id`')
            ->join('LEFT JOIN', 'space as s', 'sm.space_id = `s`.`id`')
            ->join('INNER JOIN', 'votes as v', 'v.evidence_id = `e`.`id` and v.user_type = "Mentors"')
            ->where(['m.id' => $mission_id, 'c.visibility' => 1, 'a.is_group' => 1, 's.id' => $team_id,'m.locked' => 0])
            ->groupBy('e.id')
            ->all();

            //get total
           $total_evidences_group_activity = DashboardMissionProgressIndicator::getQueryTotal($total_evidences_group_activity);
        }

        $total_evidences += $total_evidences_group_activity;

        //debug
        //print("te: ".$total_evidences." ta:".$total_activities."<br>");

        $stats['total_activities'] = $total_activities;
        $stats['total_evidences'] = $total_evidences;

        return $stats;
    }

}

?>
