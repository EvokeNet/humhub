<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;
use app\modules\teams\models\Team;

class DashboardMissionProgressIndicator extends \yii\base\Widget
{


    /**
     * @inheritdoc
     */
    public function run()
    {
    	$progress = DashboardMissionProgressIndicator::getProgress();

    	print_r($progress);	

        return $this->render('dashboard_mission_progress_indicator', []);
    }

    public static function getMissionIds()
    {
		return (new \yii\db\Query())
	        ->select(['m.id'])
	        ->from('missions as m')
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

    public static function getMissionCompletion($mission_id)
    {
    	$user = Yii::$app->user->getIdentity();

    	$total_activities = (new \yii\db\Query())
    		->select(['count(a.id) as total_activities'])
        	->from('activities as a')
        	->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
        	->where(['m.id' => $mission_id])
	        ->one()['total_activities'];

    	$total_evidences = (new \yii\db\Query())
    		->select(['count(e.id) as total_evidences'])
        	->from('activities as a')
        	->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
        	->join('LEFT JOIN', 'evidence as e', 'e.activities_id = `a`.`id` and e.created_by = '.$user->id)
        	->join('LEFT JOIN', 'content as c', 'c.object_id = `e`.`id` and c.object_model like "%Evidence%"')
        	->join('INNER JOIN', 'votes as v', 'v.evidence_id = `e`.`id` and v.user_type = "Mentors"')
        	->where(['m.id' => $mission_id, 'c.visibility' => 1, 'a.is_group' => 0])
        	->groupBy('e.created_by')
	        ->one()['total_evidences'];

		$total_evidences_group_activity = 0;

		//check group activity

		$total_group_activities = (new \yii\db\Query())
    		->select(['count(a.id) as total_activities'])
        	->from('activities as a')
        	->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
        	->where(['m.id' => $mission_id, 'a.is_group' => 1])
	        ->one()['total_activities'];

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
        	->where(['m.id' => $mission_id, 'c.visibility' => 1, 'a.is_group' => 1, 's.id' => $team_id])
        	->groupBy('m.id')
	        ->one()['total_evidences'];   
	    }

	    $total_evidences += $total_evidences_group_activity;

	    //debug
	    //print("te: ".$total_evidences." ta:".$total_activities."<br>");

	   	return ($total_activities == $total_evidences) ? true : false;
    }

}

?>
