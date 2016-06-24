<?php

namespace humhub\modules\static_pages\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class StaticPagesController extends Controller
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

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHowTo()
    {
        return $this->render('how_to');
    }

    public function actionPrivacyPolicy()
    {
        return $this->render('privacy_policy');
    }

    public function actionTermsConditions()
    {
        return $this->render('terms_conditions');
    }

}
