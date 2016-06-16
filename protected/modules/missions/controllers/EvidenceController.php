<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use humhub\modules\content\components\ContentContainerController;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use humhub\modules\missions\controllers\AlertController;

class EvidenceController extends ContentContainerController
{

    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\missions\components\StreamAction::className(),
                'mode' => \humhub\modules\missions\components\StreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer
            ),
        );
    }   

   
    public function actionActivities($missionId)
    {   
        $mission = Missions::find()
        ->where(['=', 'id', $missionId])
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
        ])->one();
                
        return $this->render('activities', array('mission' => $mission, 'contentContainer' => $this->contentContainer));
    }

    public function actionMissions()
    {   

        //$missions = Missions::find()->all();
        
        $missions = Missions::find()->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
        ])->all();
        
        return $this->render('missions', array('missions' => $missions, 'contentContainer' => $this->contentContainer));
    }

    public function getEvidenceCreatedMessage($activityPowers){
       $message = Yii::t('MissionsModule.base', 'You just gained').' ';

       $count = 0;
       $powersTotal = count($activityPowers);

       foreach($activityPowers as $activity_power){
            $count++;

            if($count == $powersTotal - 1){
                $separator = ' '.Yii::t('MissionsModule.base', 'and').' ';
            }elseif($count < $powersTotal - 1){
                $separator = ", ";
            }else{
                $separator = ".";
            }

            if($activity_power->value > 1){
                $pointString = "points";
            }else{
                $pointString = "point";
            }

            $message = $message . $activity_power->value . ' '. $pointString . ' in '. $activity_power->getPower()->title . $separator;
       }

       return $message;

    }

    /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionShow($activityId)
    {           
        $activity = Activities::find()
        ->where(['=', 'id', $activityId])
        ->with([
            'activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
        ])->one();

        return $this->render('show', array(
                    'contentContainer' => $this->contentContainer,
                    'activity' => $activity,
                    'space' => $this->space,
        ));
    }

    /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionCreate()
    {
        if (!$this->contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence())) {
            throw new HttpException(400, 'Access denied!');
        }

        $evidence = new Evidence();
        $evidence->scenario = Evidence::SCENARIO_CREATE;
        $evidence->title = Yii::$app->request->post('title');
        $evidence->text = Yii::$app->request->post('text');
        $evidence->activities_id = Yii::$app->request->post('activityId');

        //ACTIVITY POWER POINTS
        $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);
        $user = Yii::$app->user->getIdentity();

        //USER POWER POINTS
        foreach($activityPowers as $activity_power){
            $userPower = UserPowers::findOne(['power_id' => $activity_power->power_id, 'user_id' => $user->id]);
            if(isset($userPower)){
                if(!isset($userPower->value)){
                    $userPower->value = 0;
                }
                $userPower->value += $activity_power->value;
                $userPower->save();
            }else{
                $userPower = new UserPowers();
                $userPower->user_id = $user->id;
                $userPower->power_id = $activity_power->power_id;
                $userPower->value = $activity_power->value;
                $userPower->save();
            }
            
        }

        $message = $this->getEvidenceCreatedMessage($activityPowers);
        AlertController::createAlert("Congratulations!", $message);

        return \humhub\modules\missions\widgets\WallCreateForm::create($evidence, $this->contentContainer);
    }


   public function actionEdit()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');

        $edited = false;
        $model = Evidence::findOne(['id' => $id]);
        $model->scenario = Evidence::SCENARIO_EDIT;

        if (!$model->content->canWrite()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }


        if ($model->load($request->post())) {

            Yii::$app->response->format = 'json';
            $result = [];
            if ($model->validate() && $model->save()) {
                // Reload record to get populated updated_at field
                $model = Evidence::findOne(['id' => $id]);
                $result['success'] = true;
                $result['output'] = $this->renderAjaxContent($model->getWallOut(['justEdited' => true]));
            } else {
                $result['errors'] = $model->getErrors();
            }
            return $result;
        }

        return $this->renderAjax('edit', ['evidence' => $model, 'edited' => $edited]);
    }

    /**
     * Reloads a single entry
     */
    public function actionReload()
    {
        $id = Yii::$app->request->get('id');
        $model = Evidence::findOne(['id' => $id]);

        if (!$model->content->canRead()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }

        return $this->renderAjaxContent($model->getWallOut(['justEdited' => true]));
    }

    public function actionReview(){
        $user = Yii::$app->user->getIdentity();

        $flag = Yii::$app->request->get("opt") == "no" ? 0 : 1;
        $grade = Yii::$app->request->get("grade");
        $evidenceId = Yii::$app->request->get("evidenceId");

        $vote = Votes::findOne(['user_id' => $user->id, 'evidence_id' => $evidenceId]);

        //If review is valid 
        if(($flag == 0 || $grade >= 1) && $evidenceId){

            //if user's editing vote
            if($vote){

                $vote->flag = $flag;
                $vote->value = $grade;
                $vote->save();

                AlertController::createAlert("Congratulations!", "Your review was updated!");

            }else{
                //SAVE VOTE
                $vote = new Votes();
                $vote->user_id = $user->id;
                $vote->activity_id = Evidence::findOne($evidenceId)->activities_id;
                $vote->evidence_id = $evidenceId;
                $vote->flag = $flag;
                $vote->value = $grade;
                $vote->save();

                //SAVE POWER POINTS
                $power = Activities::findOne($vote->activity_id)->getPrimaryPowers()[0]->getPower();
                $userPower = UserPowers::findOne(['power_id' => $power->id, 'user_id' => $user->id]);
                if(isset($userPower)){
                    if(!isset($userPower->value)){
                        $userPower->value = 0;
                    }
                    $userPower->value += 10;
                    $userPower->save();
                }else{
                    $userPower = new UserPowers();
                    $userPower->user_id = $user->id;
                    $userPower->power_id = $power->id;
                    $userPower->value = 10;
                    $userPower->save();
                }       

                $message = "You just gained 10 points in ".$power->title;

                AlertController::createAlert("Congratulations!", $message.".<BR>Thank you for your review.");
            }
        }else{
            AlertController::createAlert("Error", "Oops! Something's wrong.");
        }
        
    }



}
