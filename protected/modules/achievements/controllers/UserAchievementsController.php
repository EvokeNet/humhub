<?php

namespace humhub\modules\achievements\controllers;

class UserAchievementsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
