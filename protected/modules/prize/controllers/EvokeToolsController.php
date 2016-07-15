<?php

namespace humhub\modules\prize\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\prize\models\Prize;

/**
 * Evoke Tools Controller
 *
 */
class EvokeToolsController extends Controller
{

    public function actionIndex()
    {
        $prizes = Prize::find()->all();

        return $this->render('evoke_tools/index', array('prizes' => $prizes));
    }

    public function actionSearch()
    {
      $prizes = Prize::find()->all();
      $roll = mt_rand(0, 1000);
      $results = $roll;

      return $this->render('evoke_tools/index', array('prizes' => $prizes, 'results' => $results));
    }
}
