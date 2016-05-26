<?php

namespace humhub\modules\missions\controllers;

use Yii;
use yii\web\HttpException;
use humhub\components\Controller;

/**
 * Description of DefaultController
 *
 * @author luke
 */
class DefaultController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

}

