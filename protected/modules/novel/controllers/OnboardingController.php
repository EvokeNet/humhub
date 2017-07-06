<?php

namespace humhub\modules\novel\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use humhub\modules\user\models\User;
use app\modules\missions\models\forms\EvokeSettingsForm;


/**
 * Onboarding Controller
 *
 */
class OnboardingController extends Controller
{
    public function actionIntroduction()
    {
        return $this->render('intro');
    }

    public function actionVideo()
    {
        return $this->render('video');
    }

}
