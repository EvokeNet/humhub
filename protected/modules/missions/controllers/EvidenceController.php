<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use humhub\modules\missions\components\ContentContainerController;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;

class EvidenceController extends ContentContainerController
{

    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\missions\components\StreamAction::className(),
                'mode' => \humhub\modules\missions\components\StreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer,
                'activity_id' => Yii::$app->request->get('activity_id'),
             ),
            'userfeed' => array(
                'class' => \humhub\modules\missions\components\UserStreamAction::className(),
                'mode' => \humhub\modules\missions\components\UserStreamAction::MODE_NORMAL,
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
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();
                
        return $this->render('activities', array('mission' => $mission, 'contentContainer' => $this->contentContainer));
    }

    public function actionMissions()
    {   

        //$missions = Missions::find()->all();
        
        $missions = Missions::find()
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])
        ->where(['locked' => 0])
        ->all();
        
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
                $pointString = Yii::t('MissionsModule.base', 'points');
            }else{
                $pointString = Yii::t('MissionsModule.base', 'point');
            }

            $message = $message . $activity_power->value . ' '. $pointString .' '. Yii::t('MissionsModule.base', 'in').' '. $activity_power->getPower()->title . $separator;
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

        if(!Yii::$app->request->post('title')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Title cannot be blank.'));
        }else if(!Yii::$app->request->post('text')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Text cannot be blank.'));
        }else{

            //ACTIVITY POWER POINTS
            $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);
            $user = Yii::$app->user->getIdentity();

            //USER POWER POINTS
            foreach($activityPowers as $activity_power){
                UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
            }



            $message = $this->getEvidenceCreatedMessage($activityPowers);
            AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), $message);

        }

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
        $comment = Yii::$app->request->get("comment");
        $evidenceId = Yii::$app->request->get("evidenceId");
        $evidence = $evidenceId ? Evidence::findOne($evidenceId) : null;

        $vote = Votes::findOne(['user_id' => $user->id, 'evidence_id' => $evidenceId]);

        /*
            Check if review is valid:
            *** - it has a 'no' vote or a 1-5 'yes' vote
            *** - it has an evidence id associated
            *** - evidence author isn't the same user who's reviewing
        */
        if(($flag == 0 || $grade >= 1) && $evidenceId && $evidence->content->user_id != $user->id){

            //if user's editing vote
            if($vote){
                $pointChange = $grade - $vote->value;

                $vote->flag = $flag;
                $vote->comment = $comment;
                $vote->value = $grade;
                $vote->save();

                //updated evidence author's reward
                $activityPower = Activities::findOne($vote->activity_id)->getPrimaryPowers()[0];
                UserPowers::addPowerPoint($activityPower->getPower(), User::findOne($evidence->content->user_id), $pointChange);

                AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', 'Your review was updated!'));
                
            }else{
                //SAVE VOTE
                $vote = new Votes();
                $vote->user_id = $user->id;
                $vote->activity_id = $evidence->activities_id;
                $vote->evidence_id = $evidenceId;
                $vote->comment = $comment;
                $vote->flag = $flag;
                $vote->value = $grade;
                $vote->save();

                //Reward reviewer
                $activityPower = Activities::findOne($vote->activity_id)->getPrimaryPowers()[0];
                UserPowers::addPowerPoint($activityPower->getPower(), $user, 10);
                //Reward evidence author
                if($flag){
                    UserPowers::addPowerPoint($activityPower->getPower(), User::findOne($evidence->content->user_id), $grade);
                }

                $message = Yii::t('MissionsModule.base', 'You just gained 10 points in {message}', array('message' => $activityPower->getPower()->title));
                
                AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', '{message}. <BR>Thank you for your review.', array('message' => $message)));
            }
        } else{
            AlertController::createAlert("Error", "Oops! Something's wrong.");
        }
        
    }



}
