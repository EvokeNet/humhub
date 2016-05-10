<?php

namespace humhub\modules\missions\controllers;

use Yii;
use humhub\modules\missions\models\Missions;
use humhub\modules\missions\models\MissionTranslations;
use humhub\modules\missions\models\Activities;
use humhub\modules\missions\models\ActivityTranslations;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
        $missions = Missions::find()->all();
        return $this->render('index', array('missions' => $missions));
    }

    public function actionAdd()
    {
        $model = new Missions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } 
        
        return $this->render('add', array('model' => $model));
    }

    public function actionEdit($id)
    {
        $model = Missions::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('edit', array('model' => $model));
    }

    public function actionDelete()
    {
        $model = Missions::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }
    
  /**
    * Activities Actions
    *
    **/
    public function actionIndexActivities($id)
    {
        $activities = Activities::find()
        ->where(['mission_id' => Yii::$app->request->get('id')])
        ->all();
        
        $mission = Missions::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('activities/index', array('activities' => $activities, 'mission' => $mission));
    }
    
    public function actionAddActivities($id)
    {
        $model = new Activities();
        $model->mission_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-activities', 'id' => $model->mission_id]);
        } 
        
        return $this->render('activities/add', array('model' => $model));
    }
    
    public function actionEditActivities($id)
    {
        $model = Activities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activities', 'id' => $model->mission_id]);
        }

        return $this->render('activities/edit', array('model' => $model));
    }
    
    public function actionDeleteActivities()
    {
        $model = Activities::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->mission_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-activities', 'id' => $mid]);
    }
    
    /**
    * Mission Translations Actions
    *
    **/
    public function actionIndexMissionTranslations($id)
    {
        $mission_translations = MissionTranslations::find()
        ->where(['mission_id' => Yii::$app->request->get('id')])
        ->with('language')
        ->all();
        
        // $customers = Books::find()->with([
        //     'bookTranslations' => function ($query) {
        //         $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         $query->andWhere(['language_id' => $lang->id]);
        //     },
        // ])->all();
        
        $mission = Missions::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('mission-translations/index', array('mission_translations' => $mission_translations, 'mission' => $mission));
    }
    
    public function actionAddMissionTranslations($id)
    {
        $model = new MissionTranslations();
        $model->mission_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-mission-translations', 'id' => $model->mission_id]);
        } 
        
        return $this->render('mission-translations/create', array('model' => $model));
    }
    
    public function actionEditMissionTranslations($id)
    {
        $model = MissionTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-mission-translations', 'id' => $model->mission_id]);
        }

        return $this->render('mission-translations/update', array('model' => $model));
    }
    
    public function actionDeleteMissionTranslations()
    {
        $model = MissionTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->mission_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-mission-translations', 'id' => $mid]);
    }
    
    /**
    * Activity Translations Actions
    *
    **/
    public function actionIndexActivityTranslations($id)
    {
        $activity_translations = ActivityTranslations::find()
        ->where(['activity_id' => Yii::$app->request->get('id')])
        ->with('language')
        ->all();
        
        // $customers = Books::find()->with([
        //     'bookTranslations' => function ($query) {
        //         $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         $query->andWhere(['language_id' => $lang->id]);
        //     },
        // ])->all();
        
        $activity = Activities::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('activity-translations/index', array('activity_translations' => $activity_translations, 'activity' => $activity));
    }
    
    public function actionAddActivityTranslations($id)
    {
        $model = new ActivityTranslations();
        $model->activity_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-activity-translations', 'id' => $model->activity_id]);
        } 
        
        return $this->render('activity-translations/create', array('model' => $model));
    }
    
    public function actionEditActivityTranslations($id)
    {
        $model = ActivityTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activity-translations', 'id' => $model->activity_id]);
        }

        return $this->render('activity-translations/update', array('model' => $model));
    }
    
    public function actionDeleteActivityTranslations()
    {
        $model = ActivityTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->activity_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-activity-translations', 'id' => $mid]);
    }
    
}
