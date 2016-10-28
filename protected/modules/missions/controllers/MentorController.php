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
        $teams = Team::getTeamsFollowed(Yii::$app->user->getIdentity()->id);

        return $this->render('teams', ['teams' => $teams]);
    }

    public function actionTeams()
    {

        $teamsQuery = Team::find()->where(['is_team' => '1']);

        return $this->render('teams', ['teams' => $teamsQuery->all()]);

    }

}

?>
