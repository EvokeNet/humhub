<?php

namespace app\modules\matching_questions\controllers;

use yii\web\Controller;

/**
 * Default controller for the `matching_questions` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
