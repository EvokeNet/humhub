<?php

namespace humhub\modules\novel\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\novel\models\NovelPage;
use humhub\modules\user\models\User;

/**
 * Novel Controller
 *
 */
class NovelController extends Controller
{
    public $max_prob = 1000;

    public function actionIndex()
    {
        $pages = NovelPage::find()->orderBy('page_number ASC')->all();


        return $this->render('novel/index', array('pages' => $pages));
    }
}
