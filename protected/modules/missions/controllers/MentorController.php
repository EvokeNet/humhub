<?php

namespace humhub\modules\missions\controllers;

use Yii;
use yii\web\Controller;
use app\modules\teams\models\Team;
use humhub\modules\space\models\Space;


class MentorController extends Controller
{

	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return array(
        );
    }

    public function actionMyteams()
    {
        $teams_following = (new \yii\db\Query())
        ->select(['s.id'])
        ->from('user_follow as u')
        ->join('INNER JOIN', 'space as s', '`u`.`object_id` = `s`.`id`')
        ->where(['s.is_team' => '1'])
        ->andWhere(['u.user_id' => Yii::$app->user->getIdentity()->id])
        ->andFilterWhere(
           ['u.object_model' => Space::className()])
        ->all();

        $teamsQuery = Team::find()->where(['id' => $teams_following]);

        return $this->render('teams', ['teams' => $teamsQuery->all()]);
        
    }

    public function actionTeams()
    {

        $teamsQuery = Team::find()->where(['is_team' => '1']);

        return $this->render('teams', ['teams' => $teamsQuery->all()]);
        
    }

}

?>
