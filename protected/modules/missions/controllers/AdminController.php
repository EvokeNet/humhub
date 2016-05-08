<?php

namespace humhub\modules\missions\controllers;

use Yii;
use humhub\modules\missions\models\Missions;
use humhub\modules\missions\models\Activities;

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
        
        return $this->render('index-activities', array('activities' => $activities, 'mission' => $mission));
    }
    
    public function actionAddActivities($id)
    {
        $model = new Activities();
        $model->mission_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activities', 'id' => $model->mission_id]);
        } 
        
        return $this->render('add-activities', array('model' => $model));
    }
    
    public function actionEditActivities($id)
    {
        $model = Activities::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-activities', 'id' => $model->mission_id]);
        }

        return $this->render('edit-activities', array('model' => $model));
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
    

}
