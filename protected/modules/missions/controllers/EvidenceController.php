<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
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
        $mission = Missions::findOne($missionId);
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

    /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionShow($activityId)
    {	
        $activity = Activities::findOne($activityId);

        return $this->render('show', array(
                    'contentContainer' => $this->contentContainer,
                    'activity' => $activity,
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
            $userPower->value += $activity_power->value;
            $userPower->save();
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


}
