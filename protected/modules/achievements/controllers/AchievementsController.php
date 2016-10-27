<?php

namespace humhub\modules\achievements\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\achievements\models\Achievements;
use app\modules\achievements\models\UserAchievements;
use humhub\modules\missions\controllers\AlertController;

class AchievementsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        //get user id (evidence's author)
        $user_id = Yii::$app->user->getIdentity()->id;

        //get user's evidence count
        $evidences_count = Evidence::find()
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `evidence`.`id` = `c`.`object_id`')
        ->where(['evidence.created_by' => $user_id])
        ->andWhere(['visibility' => 1])
        ->count();

        $evidences_count = 50;

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

        AlertController::createAlert("Congratulations!", "You've submitted 6 evidences! <div><img src=\"https://cdn0.iconfinder.com/data/icons/sport-balls/512/gold_medal.png\" /></div>");
        AlertController::createAlert("Congratulations!", "You've submitted 12 evidences! <div><img src=\"https://cdn0.iconfinder.com/data/icons/sport-balls/512/gold_medal.png\" /></div>");
        AlertController::createAlert("Congratulations!", "You've submitted 24 evidences! <div><img src=\"https://cdn0.iconfinder.com/data/icons/sport-balls/512/gold_medal.png\" /></div>");
        //AlertController::createAlert("Teste!", "Olá!");

        /* 
        *	Loop starting at 6 (smaller achievement) if there's no reached achievement yet or next possible achievement (current highest * 2)
        *
        *	Code example:
        *	User submitted total 24 evidences and latest achievement is evidence_12
        *	max(6, 12*2) = 24
        * 	loop starts at 24
        *	User's total evidences >= 24? Yes, then create new user achievement
        * 	next iteration: $x*=2, then 24*=2 equals 48
        *	User's total evidences >= 48? No, then loop is ended
        */

        for($x = max(6, $latest_achievement * 2); $x <= 48; $x*=2){
        	if($evidences_count >= $x){
        		// find achievement
        		$achievement = Achievements::findOne(['code' => 'evidence_'.$x]);
        		//create new user achievement
        		$user_achievement = new UserAchievements();
        		$user_achievement->achievement_id = $achievement->id;
        		$user_achievement->user_id = $user_id;
        		$user_achievement->save();

        		AlertController::createAlert("Teste", "Olá!");

        	}else{
        		break;
        	}
        }
    }

}
