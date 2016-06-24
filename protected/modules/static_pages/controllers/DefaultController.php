<?php

namespace app\modules\static_pages\controllers;

use yii\web\Controller;

/**
 * Default controller for the `static_pages` module
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
