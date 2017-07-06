<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Evidence;
use app\modules\teams\models\Team;

class EvocoinsReview extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
    	$mission_progress = array();
        $mission_total = array();
        $current_mission = array();

        $missions = Missions::find()
        ->with(['activities', 'activities.evidences', 'activities.activityPowers'])
        ->where(['missions.locked' => 0])
        ->orderBy('missions.position ASC')
        ->all();

        foreach($missions as $m):

            $stats = EvocoinsReview::getMissionStats1($m->id);
        	
        	if($stats['evidences'] != $stats['activities']){
        		$current_mission = $m;
        		break;
        	}

        endforeach;

        return $this->render('evocoins_review', array('missions' => $missions, 'mission_total' => $mission_total,'mission_progress' => $mission_progress, 'current_mission' => $current_mission));
    }

    public static function getMissionStats1($mission_id)
    {
        $user = Yii::$app->user->getIdentity();

        $team_id = Team::getUserTeam($user->id);

        $e = (new \yii\db\Query())
        ->select(['count(e.id) as count'])
        ->from('evidence as e')
        ->join('LEFT JOIN', 'activities as a', 'e.activities_id = `a`.`id`')
        ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->where(['m.id' => $mission_id, 'c.space_id' => $team_id, 'c.visibility' => 1, 'm.locked' => 0])
        // ->andWhere(['c.visibility' => 1])
        ->one()['count'];

        $a = $total = (new \yii\db\Query())
        ->select(['count(e.id) as count'])
        ->from('activities as a')
        ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
        ->where(['m.id' => $mission_id)
        // ->andWhere(['c.visibility' => 1])
        ->one()['count'];

        $stats['evidences'] = $e;
        $stats['activities'] = $a;

        return $stats;
    }

}

?>