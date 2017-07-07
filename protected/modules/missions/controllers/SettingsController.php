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
        $form->enabled_intro_slide = Setting::Get('enabled_intro_slide');
        $form->enabled_intro_video = Setting::Get('enabled_intro_video');
        $form->enabled_psychometric_questionnaire_obligation = Setting::Get('enabled_psychometric_questionnaire_obligation');
        $form->enabled_novel_read_obligation = Setting::Get('enabled_novel_read_obligation');
        $form->investment_limit = Setting::Get('investment_limit');
        $form->novel_order = Setting::Get('novel_order');

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            Setting::Set('enabled_evokations', $form->enabled_evokations);
            Setting::Set('enabled_evokation_page_visibility', $form->enabled_evokation_page_visibility);
            Setting::Set('enabled_intro_slide', $form->enabled_intro_slide);
            Setting::Set('enabled_intro_video', $form->enabled_intro_video);
            Setting::Set('enabled_psychometric_questionnaire_obligation', $form->enabled_psychometric_questionnaire_obligation);
            Setting::Set('enabled_novel_read_obligation', $form->enabled_novel_read_obligation);
            Setting::Set('investment_limit', $form->investment_limit);
            Setting::Set('novel_order', $form->novel_order);

            Yii::$app->getSession()->setFlash('data-saved', Yii::t('AdminModule.controllers_SettingController', 'Saved'));
            return Yii::$app->response->redirect(Url::toRoute('/missions/settings'));
        }

        return $this->render('index', ['model' => $form]);
    }   
}

