<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Missions;
use app\modules\missions\models\MissionTranslations;
use app\modules\missions\models\Activities;
use app\modules\missions\models\ActivityTranslations;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\DifficultyLevels;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{

    public function actionIndex()
    {
        $missions = Missions::find()->all();
        return $this->render('missions/index', array('missions' => $missions));
    }
    
    public function actionView($id)
    {   
        $model = Missions::findOne(['id' => Yii::$app->request->get('id')]);
        return $this->render('missions/view', array('model' => $model));
        
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    public function actionCreate()
    {
        $model = new Missions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } 
        
        return $this->render('missions/create', array('model' => $model));
    }

    public function actionUpdate($id)
    {
        $model = Missions::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('missions/update', array('model' => $model));
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
    
    public function actionCreateActivities($id)
    {
        $model = new Activities();
        $model->mission_id = $id;
        
        $mission = Missions::findOne(['id' => Yii::$app->request->get('id')]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-activities', 'id' => $model->mission_id]);
        } 
        
        return $this->render('activities/create', array('model' => $model, 'mission' => $mission));
        
        // return $this->render('activities/test', array('model' => $model, 'mission' => $mission));
    }
    
    public function actionUpdateActivities($id)
    {
        $model = Activities::findOne(['id' => Yii::$app->request->get('id')]);
        
        $mission = Missions::findOne(['id' => $model->mission_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activities', 'id' => $model->mission_id]);
        }

        return $this->render('activities/update', array('model' => $model, 'mission' => $mission));
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
    
    public function actionCreateMissionTranslations($id)
    {
        $model = new MissionTranslations();
        $model->mission_id = $id;
        
        $mission = Missions::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-mission-translations', 'id' => $model->mission_id]);
        } 
        
        return $this->render('mission-translations/create', array('model' => $model, 'mission' => $mission));
    }
    
    public function actionUpdateMissionTranslations($id)
    {
        $model = MissionTranslations::findOne(['id' => Yii::$app->request->get('id')]);
        
        $mission = Missions::findOne(['id' => $model->mission_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-mission-translations', 'id' => $model->mission_id]);
        }

        return $this->render('mission-translations/update', array('model' => $model, 'mission' => $mission));
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
    
    public function actionCreateActivityTranslations($id)
    {
        $model = new ActivityTranslations();
        $model->activity_id = $id;
        
        $activity = Activities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-activity-translations', 'id' => $model->activity_id]);
        } 
        
        return $this->render('activity-translations/create', array('model' => $model, 'activity' => $activity));
    }
    
    public function actionUpdateActivityTranslations($id)
    {
        $model = ActivityTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        $activity = Activities::findOne(['id' => $model->activity_id]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activity-translations', 'id' => $model->activity_id]);
        }

        return $this->render('activity-translations/update', array('model' => $model, 'activity' => $activity));
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
    
    /**
    * Activity Powers Actions
    *
    **/
    public function actionIndexActivityPowers($id)
    {
        $activity_powers = ActivityPowers::find()
        ->where(['activity_id' => Yii::$app->request->get('id')]) 
        ->all();
        
        // $customers = Books::find()->with([
        //     'bookTranslations' => function ($query) {
        //         $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         $query->andWhere(['language_id' => $lang->id]);
        //     },
        // ])->all();
        
        $activity = Activities::findOne(['id' => Yii::$app->request->get('id')]);
        
        return $this->render('activity-powers/index', array('activity_powers' => $activity_powers, 'activity' => $activity));
    }
    
    public function actionCreateActivityPowers($id)
    {
        $model = new ActivityPowers();
        $model->activity_id = $id;
        
        $activity = Activities::findOne(['id' => Yii::$app->request->get('id')]);
        
        $model->value = $activity->difficultyLevel->points;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['index-activities', 'id' => $model->mission_id]);
            return $this->redirect(['index-activity-powers', 'id' => $model->activity_id]);
        } 
        
        return $this->render('activity-powers/create', array('model' => $model, 'activity' => $activity));
    }
    
    public function actionUpdateActivityPowers($id)
    {
        $model = ActivityPowers::findOne(['id' => Yii::$app->request->get('id')]);

        $activity = Activities::findOne(['id' => $model->activity_id]);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activity-powers', 'id' => $model->activity_id]);
        }

        return $this->render('activity-powers/update', array('model' => $model, 'activity' => $activity));
    }
    
    public function actionDeleteActivityPowers()
    {
        $model = ActivityPowers::findOne(['id' => Yii::$app->request->get('id')]);
        $mid = $model->activity_id;
        
        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-activity-powers', 'id' => $mid]);
    }
    
}
