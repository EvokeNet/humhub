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

class EvokationController extends ContentContainerController
{

    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\missions\components\EvokationStreamAction::className(),
                'mode' => \humhub\modules\missions\components\EvokationStreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer
             ),
        );
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

}
