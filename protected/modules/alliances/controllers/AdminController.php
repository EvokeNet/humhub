<?php

namespace humhub\modules\alliances\controllers;

use Yii;
use app\modules\alliances\models\Alliance;
use app\modules\teams\models\Team;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
      $alliances = Alliance::find()->orderBy('created_at')->all();

      return $this->render('alliances/index', array('alliances' => $alliances));
    }

    public function actionCreate()
    {
      $model = new Alliance();

      $allied_teams = Alliance::find()->select('team_1, team_2')->all();
      $allied_team_ids = [];

      foreach ($allied_teams as $allied_team) {
        $allied_team_ids[] = $allied_team->team_1;
        $allied_team_ids[] = $allied_team->team_2;
      }

      $teams = Team::find()->where(['not in', 'id', $allied_team_ids])->all();


      if ($model->load(Yii::$app->request->post())) {

        if ($model->team_1 == $model->team_2) {
          return $this->render('alliances/create', array('teams' => $teams, 'model' => $model));
        }

        $model->created_at = date("Y-m-d H:i:s");

        if($model->save())
            return $this->redirect(['index']);
      }

      return $this->render('alliances/create', array('teams' => $teams, 'model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Alliance::findOne(['id' => Yii::$app->request->get('id')]);

        $allied_teams = Alliance::find()->select('team_1, team_2')->where(['not in', 'id', $model->id])->all();
        $allied_team_ids = [];

        foreach ($allied_teams as $allied_team) {
          $allied_team_ids[] = $allied_team->team_1;
          $allied_team_ids[] = $allied_team->team_2;
        }

        $teams = Team::find()->where(['not in', 'id', $allied_team_ids])->all();

        if ($model->load(Yii::$app->request->post())) {

          if ($model->save()) {
            return $this->redirect(['index']);
          }
        }

        return $this->render('alliances/update', array('teams' => $teams, 'model' => $model));
    }

    public function actionDelete()
    {
        $model = Alliance::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
}
