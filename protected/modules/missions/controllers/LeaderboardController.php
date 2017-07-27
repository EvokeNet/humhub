<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\teams\models\Team;
use app\modules\missions\models\Evidence;
use humhub\modules\user\models\User;
use app\modules\missions\models\Missions;

class LeaderboardController extends \yii\web\Controller
{

    //Users and Teams
    public function getRankingObjectPosition($ranking, $object_id, $classname){

        foreach($ranking as $key => $object){
            if($object['id'] == $object_id){
                $object['position'] = $key;
                return $object;
            }
        }

        if($classname == User::classname()){
            $object = (new \yii\db\Query())
                ->select(['u.*', 'p.firstname', 'p.lastname'])
                ->from('user as u')
                ->join('INNER JOIN', 'profile as p', 'u.id = `p`.`user_id`')
                ->where('id = '.$object_id)
                ->one();

        }elseif($classname == Team::classname()){
            $object = (new \yii\db\Query())
                ->select(['s.*'])
                ->from('space as s')
                ->where('id = '.$object_id)
                ->one();

        }else{
            return;
        }

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

    public function getRankTeamsQualityEvidences($limit = ""){

        $inside_query =  (new \yii\db\Query())
        ->select(['s.*'])
        ->from('space as s')
        ->join('INNER JOIN', 'content as c', 's.id = `c`.`space_id`')
        ->join('INNER JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('INNER JOIN', 'votes as v', 'e.id = `v`.`evidence_id`')
        ->where('s.is_team = 1')
        ->limit($limit)
        ->groupBy('e.id')
        ->having('avg(v.value) >= 3');

        $inside_query = "(SELECT s.* FROM `space` `s` INNER JOIN `content` `c` ON s.id = `c`.`space_id`  INNER JOIN `evidence` `e` ON `c`.`object_model`='app\\\\modules\\\\missions\\\\models\\\\Evidence' AND `c`.`object_id` = `e`.`id` INNER JOIN `votes` `v` ON e.id = `v`.`evidence_id`  WHERE s.is_team = 1  GROUP BY `e`.`id` HAVING avg(v.value) >= 3)";

        $team_evidences =  (new \yii\db\Query())
        ->select('total.*, count(total.id) as evidences')
        ->from($inside_query.' as total')
        ->limit($limit)
        ->groupBy('total.id')
        ->orderBy('evidences desc')
        ->all();

        return $team_evidences;
    }

    public function getMissionAverageRatingRanking($limit = "", $mission_id){
        return  (new \yii\db\Query())
        ->select(['s.*, avg(v.value) as rating'])
        ->from('space as s')
        ->join('INNER JOIN', 'content as c', 's.id = `c`.`space_id`')
        ->join('INNER JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('INNER JOIN', 'votes as v', '`v`.`evidence_id`= `e`.`id`')
        ->join('INNER JOIN', 'activities as a', 'a.id = `e`.`activities_id`')
        ->where('s.is_team = 1')
        ->andWhere('a.mission_id ='.$mission_id)
        ->limit($limit)
        ->groupBy('s.id')
        ->orderBy('s.id asc')
        ->all();
    }

    public function rating_cmp($a, $b){
        return strcmp($b['rating'], $a['rating']);
    }

    public function getImprovedTeamsRanking($limit = ""){
        $missions = Missions::find()
         ->where(['missions.locked' => 0])
         ->orderBy('missions.position desc')
         ->all();

        $latest_mission = $missions[0];
        $second_mission = $missions[1];

        $team_rate_1 = LeaderboardController::getMissionAverageRatingRanking("", $latest_mission->id);        
        $team_rate_2 = LeaderboardController::getMissionAverageRatingRanking("", $second_mission->id);        
        
        //new array
        $team_improvement = array();

        $last_id = 0;

        foreach($team_rate_1 as $rate_1){
           //find id in second array
           for($x = $last_id; $x < sizeof($team_rate_2); $x++){
                $rate_2 = $team_rate_2[$x];
                if($rate_2['id'] == $rate_1['id']){
                    //if found, update last_id
                    $last_id = $x+1;
                    //calc improvement
                    $improvement = $rate_1['rating'] - $rate_2['rating'];

                    //if negative, skip
                    if($improvement <= 0){
                        continue;    
                    }
                    

                    //create new object and update rating
                    $new_rate = $rate_2;
                    $new_rate['rating'] = $improvement;
                    //add to array
                    array_push($team_improvement, $new_rate);
                }
           }
        }

        usort($team_improvement, "humhub\modules\missions\controllers\LeaderboardController::rating_cmp");

        //limit ranking
        $team_improvement = array_slice($team_improvement, 0, $limit);

        return $team_improvement;
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

    public function getRankTeamsQualityReviews($limit = ""){
        $team_reviews =  (new \yii\db\Query())
        ->select(['s.*, count(v.id) as reviews'])
        ->from('space as s')
        ->join('INNER JOIN', 'space_membership as m', 's.id = `m`.`space_id`')
        ->join('INNER JOIN', 'votes as v', 'm.user_id = `v`.`user_id`')
        ->where('s.is_team = 1')
        ->andWhere('v.quality = 1')
        ->limit($limit)
        ->groupBy('s.id')
        ->orderBy('reviews desc')
        ->all();

        return $team_reviews;
    }

    public function getRankAgentsEvidences($limit = ""){
        return  (new \yii\db\Query())
        ->select(['u.*, p.firstname, p.lastname, count(e.id) as evidences'])
        ->from('user as u')
        ->join('INNER JOIN', 'profile as p', 'u.id = `p`.`user_id`')
        ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
        //->join('INNER JOIN', 'content as c', 'u.id = `c`.`user_id`')
        //->join('INNER JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('INNER JOIN', 'evidence as e', '`u`.`id` = `e`.`created_by`')
        ->where('g.name != "Mentors"')
        ->limit($limit)
        ->groupBy('u.id')
        ->orderBy('evidences desc')
        ->all();
    }

    public function getRankAgentsScore($limit = ""){
        return  (new \yii\db\Query())
        ->select(['u.*, p.firstname, p.lastname, AVG(v.value) as average'])
        ->from('user as u')
        ->join('INNER JOIN', 'profile as p', 'u.id = `p`.`user_id`')
        ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
        ->join('INNER JOIN', 'evidence as e', '`u`.`id` = `e`.`created_by`')
        ->join('INNER JOIN', 'votes as v', '`v`.`evidence_id` = `e`.`id`')
        ->join('INNER JOIN', 'user as reviewer', '`reviewer`.`id` = `v`.`user_id`')
        ->join('INNER JOIN', 'group as reviewerg', 'reviewer.group_id = `reviewerg`.`id`')
        ->where('g.name != "Mentors"')
        ->andWhere('reviewerg.name = "Mentors"')
        ->limit($limit)
        ->groupBy('u.id')
        ->orderBy('average desc')
        ->all();
    }

    public function getRankAgentsReviews($limit = ""){
        return (new \yii\db\Query())
        ->select(['u.*, p.firstname, p.lastname, count(v.id) as reviews'])
        ->from('user as u')
        ->join('INNER JOIN', 'profile as p', 'u.id = `p`.`user_id`')
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
        ->select(['u.*', 'p.firstname', 'p.lastname', 'w.amount as evocoins'])
        ->from('user as u')
        ->join('INNER JOIN', 'profile as p', 'u.id = `p`.`user_id`')
        ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
        ->join('INNER JOIN', 'coin_wallet as w', 'u.id = `w`.`owner_id`')
        ->where('g.name != "Mentors"')
        ->limit($limit)
        ->orderBy('evocoins desc')
        ->all();
    }

    public function getRankMentorsReviews($limit = "") {
      return (new \yii\db\Query())
      ->select(['u.*, p.firstname, p.lastname, count(v.id) as reviews'])
      ->from('user as u')
      ->join('INNER JOIN', 'profile as p', 'u.id = `p`.`user_id`')
      ->join('INNER JOIN', 'group as g', 'u.group_id = `g`.`id`')
      ->join('INNER JOIN', 'votes as v', 'u.id = `v`.`user_id`')
      ->where('g.name = "Mentors"')
      ->limit($limit)
      ->groupBy('u.id')
      ->orderBy('reviews desc')
      ->all();
    }

    public function actionIndex()
    {
        $user_id = Yii::$app->user->getIdentity()->id;
        $team_id = Team::getUserTeam($user_id);

        $ranking = [];

        //deactivated
        //$ranking['rank_teams_evidences'] = $this->getRankTeamsEvidences(10);

        $ranking['rank_teams_quality_evidences'] = $this->getRankTeamsQualityEvidences(10);
        

        //deactivated
        //$ranking['rank_teams_reviews'] = $this->getRankTeamsReviews(10);

        $ranking['rank_teams_quality_reviews'] = $this->getRankTeamsQualityReviews(10);

        $ranking['rank_most_improved_teams'] = $this->getImprovedTeamsRanking(10);

        if($team_id){
            //deactivated
            //$ranking['my_team_evidences'] = $this->getRankingObjectPosition($this->getRankTeamsEvidences(), $team_id, Team::classname());
            $ranking['my_team_quality_evidences'] = $this->getRankingObjectPosition($this->getRankTeamsQualityEvidences(), $team_id, Team::classname());
            //deactivated
            //$ranking['my_team_reviews'] = $this->getRankingObjectPosition($this->getRankTeamsReviews(), $team_id, Team::classname());
            $ranking['my_team_quality_reviews'] = $this->getRankingObjectPosition($this->getRankTeamsQualityReviews(), $team_id, Team::classname());
        }

        //deactivated
        //$ranking['rank_agents_evidences'] = $this->getRankAgentsEvidences(10);
        //$ranking['my_evidences'] = $this->getRankingObjectPosition($this->getRankAgentsEvidences(), $user_id, User::classname());
        //$ranking['rank_agents_reviews'] = $this->getRankAgentsReviews(10);
        //$ranking['rank_agents_evocoins'] = $this->getRankAgentsEvocoins(10);
        //$ranking['rank_agents_score'] = $this->getRankAgentsScore(10);
        //$ranking['my_evocoins'] = $this->getRankingObjectPosition($this->getRankAgentsEvocoins(), $user_id, User::classname());
        $ranking['rank_mentors_reviews'] = $this->getRankMentorsReviews(10);

        if (Yii::$app->user->getIdentity()->group->name == "Mentors") {
          $ranking['my_reviews'] = $this->getRankingObjectPosition($this->getRankMentorsReviews(), $user_id, User::classname());
        } else {
          //$ranking['my_reviews'] = $this->getRankingObjectPosition($this->getRankAgentsReviews(), $user_id, User::classname());
          //$ranking['my_score'] = $this->getRankingObjectPosition($this->getRankAgentsScore(), $user_id, User::classname());
        }

        //debugging
        // echo "<pre>";
        // print_r($ranking);
        // echo "</pre>";

        return $this->render('index', array('ranking' => $ranking));
    }

    public function actionPowers($id = ""){

        $ranking = 'default';

        if($id == 'power'){
            $ranking = 'power one';
        } else if($id == 'power_two'){
            $ranking = 'power two';
        } else{
            $ranking = 'default leaderboard';
        }

        return $this->render('index_power', array('ranking' => $ranking));
    }

}

