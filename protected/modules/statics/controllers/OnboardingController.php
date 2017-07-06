<?php

namespace humhub\modules\statics\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use humhub\modules\user\models\User;
use humhub\models\Setting;
use app\modules\missions\models\forms\EvokeSettingsForm;


/**
 * Onboarding Controller
 *
 */
class OnboardingController extends Controller
{
    public function actionIntroduction()
    {

        $next_page_link = OnboardingController::checkVideo();

        return $this->render('intro', array('next_page_link' => $next_page_link));
    }

    public function actionVideo()
    {

        $next_page_link = OnboardingController::checkAgreements();

        return $this->render('video', array('next_page_link' => $next_page_link));
    }

    public function actionAgreements()
    {

        $next_page_link = OnboardingController::checkQuestionnaireOrNovel();

        return $this->render('agreements', array('next_page_link' => $next_page_link));
    }


    public static function checkVideo(){
        if(Setting::Get('enabled_intro_video')){
            return '/statics/onboarding/video';
        }else{
            return OnboardingController::checkAgreements();
        }

    }

    public static function checkAgreements(){
        if(Setting::Get('enabled_intro_terms')){
            return '/statics/onboarding/agreements';
        }else{
            return OnboardingController::checkQuestionnaireOrNovel();
        }

    }

    public static function checkQuestionnaireOrNovel(){
        $novel_order = Setting::Get('novel_order');

        if(Setting::Get('enabled_psychometric_questionnaire_obligation')){

            // check if user hasn't superhero id yet and if user isn't a mentor
            if (!isset(Yii::$app->user->getIdentity()->superhero_identity_id) && Yii::$app->user->getIdentity()->group->name != "Mentors"){

                //check if users are obligated to see the novel
                if(Setting::Get('enabled_novel_read_obligation')){
                    //Check order
                    if($novel_order == EvokeSettingsForm::FIRST_QUESTIONNAIRE){
                        return '/matching_questions/matching-questions/matching';
                    //check if user has already read the novel
                    }else if(Yii::$app->user->getIdentity()->has_read_novel == true){
                        return '/matching_questions/matching-questions/matching';
                    }else{
                        return '/novel/novel/graphic-novel';
                    }
                }else{
                    return '/matching_questions/matching-questions/matching';
                }

            }else if(Yii::$app->user->getIdentity()->group->name != "Mentors" && Setting::Get('enabled_novel_read_obligation') && Yii::$app->user->getIdentity()->has_read_novel == false){
                return '/novel/novel/graphic-novel';
            }

        }else if(Yii::$app->user->getIdentity()->group->name != "Mentors" && Setting::Get('enabled_novel_read_obligation') && Yii::$app->user->getIdentity()->has_read_novel == false){
            return '/novel/novel/graphic-novel';
        }else{
            return '/dashboard/dashboard';
        }
    }
}
