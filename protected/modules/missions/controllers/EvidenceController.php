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

    public function actionAlert(){
        $message = null;

        if (!Yii::$app->request->isAjax) {
            //throw new HttpException('403', 'Forbidden access.');
        }

        if (Yii::$app->session->getFlash('evidence_created')) {
           $message = Yii::t('MissionsModule.base', 'You just gained').' ';
           $activityPowers = Yii::$app->session->getFlash('evidence_created');

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

                $message = $message . $activity_power->value . ' '. Yii::t('MissionsModule.base', 'and') . ' '. $activity_power->getPower()->title . $separator;
           }

            header('Content-Type: application/json; charset="UTF-8"');
            echo $message;
            Yii::$app->end();

        }

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
        Yii::$app->session->setFlash('evidence_created', $activityPowers);
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


}
