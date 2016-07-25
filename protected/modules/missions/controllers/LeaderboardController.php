<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\teams\models\Team;
use app\modules\missions\models\Evidence;

class LeaderboardController extends \yii\web\Controller
{

    //Users and Teams
    public function getRankingObjectPosition($ranking, $object_id){
    
        foreach($ranking as $key => $object){
            if($object['id'] == $object_id){
                $object['position'] = $key;
                return $object;
            }
        }

        $object = [];
        $object['id'] = $object_id;
        $object['position'] = -1;
        return $object;
    }
   
    public function getRankTeamsEvidences($limit = ""){
        $team_evidences =  (new \yii\db\Query())
        ->select(['s.*, count(e.id) as evidences'])
        ->from('space as s')
        ->join('INNER JOIN', 'content as c', 's.id = `c`.`space_id`')
        ->join('INNER JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->where('s.is_team = 1')
        ->limit($limit)
        ->groupBy('s.id')
        ->orderBy('evidences desc')
        ->all();

        return $team_evidences;
    }

    public function getRankTeamsReviews($limit = ""){
        $team_reviews =  (new \yii\db\Query())
        ->select(['s.*, count(v.id) as reviews'])
        ->from('space as s')
        ->join('INNER JOIN', 'space_membership as m', 's.id = `m`.`space_id`')
        ->join('INNER JOIN', 'votes as v', 'm.user_id = `v`.`user_id`')
        ->where('s.is_team = 1')
        ->limit($limit)
        ->groupBy('s.id')
        ->orderBy('reviews desc')
        ->all();

        return $team_reviews;   
    }

    public function getRankAgentsEvidences($limit = ""){
        return  (new \yii\db\Query())
        ->select(['u.*, count(e.id) as evidences'])
        ->from('user as u')
        ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
        ->join('INNER JOIN', 'content as c', 'u.id = `c`.`user_id`')
        ->join('INNER JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->where('g.name != "Mentors"')
        ->limit($limit)
        ->groupBy('u.id')
        ->orderBy('evidences desc')
        ->all();
    }

    public function getRankAgentsReviews($limit = ""){
        return (new \yii\db\Query())
        ->select(['u.*, count(v.id) as reviews'])
        ->from('user as u')
        ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
        ->join('INNER JOIN', 'votes as v', 'u.id = `v`.`user_id`')
        ->where('g.name != "Mentors"')
        ->limit($limit)
        ->groupBy('u.id')
        ->orderBy('reviews desc')
        ->all();
    }

    public function getRankAgentsEvocoins($limit = ""){
        return (new \yii\db\Query())
        ->select(['u.*', 'w.amount as evocoins'])
        ->from('user as u')
        ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
        ->join('INNER JOIN', 'coin_wallet as w', 'u.id = `w`.`owner_id`')
        ->where('g.name != "Mentors"')
        ->limit($limit)
        ->orderBy('evocoins desc')
        ->all();
    }

    public function actionIndex()
    {   
        $user_id = Yii::$app->user->getIdentity()->id;
        $team_id = Team::getUserTeam($user_id);

        $ranking = [];

        $ranking['rank_teams_evidences'] = $this->getRankTeamsEvidences(10);
        $ranking['my_team_evidences'] = $this->getRankingObjectPosition($this->getRankTeamsEvidences(), $team_id);
        $ranking['rank_teams_reviews'] = $this->getRankTeamsReviews(10);
        $ranking['my_team_reviews'] = $this->getRankingObjectPosition($this->getRankTeamsReviews(), $team_id);
        $ranking['rank_agents_evidences'] = $this->getRankAgentsEvidences(10);
        $ranking['my_evidences'] = $this->getRankingObjectPosition($this->getRankAgentsEvidences(), $user_id);
        $ranking['rank_agents_reviews'] = $this->getRankAgentsReviews(10);
        $ranking['my_reviews'] = $this->getRankingObjectPosition($this->getRankAgentsReviews(), $user_id);
        $ranking['rank_agents_evocoins'] = $this->getRankAgentsEvocoins(10);
        $ranking['my_evocoins'] = $this->getRankingObjectPosition($this->getRankAgentsEvocoins(), $user_id);

        //debugging
        echo "<pre>";
        print_r($ranking);
        echo "</pre>";
        
        //return $this->render('index', array('ranking' => $ranking));
    }

}
