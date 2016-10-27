<?php

namespace app\modules\achievements\controllers;

use Yii;
use yii\web\Controller;

/**
 * Achievements controller for the `achievements` module
 */

class AchievementsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
