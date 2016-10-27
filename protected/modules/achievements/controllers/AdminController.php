<?php

namespace humhub\modules\achievements\controllers;

use Yii;
use yii\web\Controller;

/**
 * Achievements controller for the `achievements` module
 */

class AdminController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->getIdentity();

        return $this->render('index', array('user' => $user));
    }

}
