<?php

namespace humhub\modules\missions\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ConfigController extends \humhub\modules\admin\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
