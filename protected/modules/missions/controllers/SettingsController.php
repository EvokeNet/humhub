<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\forms\EvokeSettingsForm;
use humhub\models\Setting;
use yii\helpers\Url;

/**
 * AdminController
 *
 */
class SettingsController extends \humhub\modules\admin\components\Controller
{
    
    public function actionIndex()
    {
        $form = new EvokeSettingsForm;
        $form->enabled_evokations = Setting::Get('enabled_evokations');
        $form->enabled_evokation_page_visibility = Setting::Get('enabled_evokation_page_visibility');

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Setting::Set('enabled_evokations', $form->enabled_evokations);
            Setting::Set('enabled_evokation_page_visibility', $form->enabled_evokation_page_visibility);

            Yii::$app->getSession()->setFlash('data-saved', Yii::t('AdminModule.controllers_SettingController', 'Saved'));
            return Yii::$app->response->redirect(Url::toRoute('/missions/settings'));
        }

        return $this->render('index', ['model' => $form]);
    }
    
}
