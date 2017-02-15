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
    $alliance_id = Yii::$app->request->get('id');

    $alliance = Alliance::find($id)->one();

    return $this->render('show', ['aliiance' => $alliance]);
  }
}
