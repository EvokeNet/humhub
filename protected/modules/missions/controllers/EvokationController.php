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
use app\modules\missions\models\EvokationCategories;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;
use app\modules\missions\models\Evokations;

class EvokationController extends ContentContainerController
{

    public function actions()
    {
    }   

   
    public function actionIndex()
    {   
        // $evidence->content->contentContainer = espaço atual
        // $evidence->activity_id = atividade atual

        // $missions = Missions::find()
        // ->with([
        //     'missionTranslations' => function ($query) {
        //         $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         $query->andWhere(['language_id' => $lang->id]);
        //     },
        //     'activities.activityTranslations' => function ($query) {
        //         $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         $query->andWhere(['language_id' => $lang->id]);
        //     },
        //     // 'activities.evidences' => function($query){
        //     //     $query->andWhere([$this->contentContainer->id]);
        //     // }
        // ])->all();
        
        $categories = EvokationCategories::find()
        ->with([
            'activities.mission.missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
            // 'activities.evidences' => function($query){
            //     $query->andWhere([$this->contentContainer->id]);
            // }
        ])->all();
        
        $missions = Missions::find()
        ->where(['locked' => 0])
        ->all();
                
        return $this->render('index', array('categories' => $categories, 'missions' => $missions, 'contentContainer' => $this->contentContainer));
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
    public function actionShow($missionId)
    {           
        $mission = Missions::find()
        ->where(['=', 'id', $missionId])
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
        ])->one();

        return $this->render('show', array(
            'contentContainer' => $this->contentContainer,
            'mission' => $mission,
            'space' => $this->space,
        ));
    }

        public function actionEdit()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');

        $edited = false;
        $model = Evokations::findOne(['id' => $id]);
        $model->scenario = Evokations::SCENARIO_EDIT;

        if (!$model->content->canWrite()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }


        if ($model->load($request->post())) {

            Yii::$app->response->format = 'json';
            $result = [];
            if ($model->validate() && $model->save()) {
                // Reload record to get populated updated_at field
                $model = Evokations::findOne(['id' => $id]);
                $result['success'] = true;
                $result['output'] = $this->renderAjaxContent($model->getWallOut(['justEdited' => true]));
            } else {
                $result['errors'] = $model->getErrors();
            }
            return $result;
        }

        return $this->renderAjax('edit', ['evokation' => $model, 'edited' => $edited]);
    }

    /**
     * Reloads a single entry
     */
    public function actionReload()
    {
        $id = Yii::$app->request->get('id');
        $model = Evokations::findOne(['id' => $id]);

        if (!$model->content->canRead()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }

        return $this->renderAjaxContent($model->getWallOut(['justEdited' => true]));
    }


}
