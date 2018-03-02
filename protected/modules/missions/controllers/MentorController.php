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
         return [
            'stream' => [
                'class' => \humhub\modules\missions\components\actions\MentorDashboardStream::className(),
            ],
        ];
    }


    public function actionDashboard(){
        return $this->render('dashboard');
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
