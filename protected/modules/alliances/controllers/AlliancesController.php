<?php

namespace humhub\modules\alliances\controllers;

use Yii;
use app\modules\alliances\models\Alliance;
use app\modules\teams\models\Team;
use humhub\modules\content\components\ContentContainerController;


/**
 * AdminController
 *
 */
class AlliancesController extends ContentContainerController
{
  public function actionShow($id) {
    $alliance = Alliance::find($id)->one();
    $user = Yii::$app->user->getIdentity();
    $team_id = Team::getUserTeam($user->id);
    $ally = $alliance->getAlly($team_id);

    return $this->render('show', ['aliiance' => $alliance, 'ally' => $ally]);
  }
}
