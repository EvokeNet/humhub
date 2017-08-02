<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Missions;
use app\modules\languages\models\Languages;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MissionsController implements the CRUD actions for Missions model.
 */
class MissionsController extends Controller
{
    /**
     * @inheritdoc
     */
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['POST'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all Missions models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new MissionsSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
        
        //$missions = Missions::find()->all();
        
        $lang = Yii::$app->language;
        
        $missions = Missions::find()->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                $query->andWhere(['language_id' => $lang->id]);
            },
        ])->all();
        
        return $this->render('index', array('missions' => $missions, 'lang' => $lang));
    }

    /**
     * Displays a single Missions model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $mission = Missions::findOne($id);
        return $this->render('view', array('mission' => $mission));
        
        // return $this->render('view', [
        //     'model' => $this->findModel($id),
        // ]);
    }

    /**
     * Creates a new Missions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Missions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Missions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Missions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Missions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Missions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Missions::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

/* DEBUG
    public function actionTest($space_id, $mission_id, $activity_id=null){
        $mission = Missions::findOne($mission_id);
        echo "Total Completed Activities: ";
        echo sizeof($mission->getCompletedActivities($space_id));
        echo "<BR>Total Activities: ";
        echo sizeof($mission->activities);
        echo "<BR>Completed? ";
        print_r($mission->hasTeamCompleted($space_id));
        echo "<BR>Completed Activities: ";
        foreach($mission->getCompletedActivities($space_id) as $activity){
            echo $activity['id'].", ";
        }
        echo "<BR>Is going to complete? ";
        print_r($mission->isTeamGoingToComplete($space_id, $activity_id));
        echo "<BR>Is REALLY completed? ";
        print_r(\app\modules\missions\models\TeamMission::isMissionCompleted($mission_id, $space_id));
    }
    */
}
