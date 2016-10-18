<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\forms\AccountEvokeSettingsForm;
use humhub\modules\user\models\Setting;
use yii\helpers\Url;

/**
 * User
 *
 */
class UserSettingsController extends \humhub\modules\user\controllers\AccountController
{
    
    // public function actionIndex()
    // {
    //     $user = Yii::$app->user->getIdentity();
    //     $form = new AccountEvokeSettingsForm;
    //     $form->enabled_review_notification_emails = Setting::Get($user->id,'enabled_review_notification_emails', 'Missions', 1);

    //     if ($form->load(Yii::$app->request->post()) && $form->validate()) {
    //         Setting::Set($user->id,'enabled_review_notification_emails', $form->enabled_review_notification_emails,'Missions');

    //         Yii::$app->getSession()->setFlash('data-saved', Yii::t('AdminModule.controllers_SettingController', 'Saved'));
    //         return Yii::$app->response->redirect(Url::toRoute('/missions/user-settings'));
    //     }

    //     return $this->render('index', ['model' => $form]);  
    // }    
}
