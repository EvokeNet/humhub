<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Missions;
use app\modules\missions\models\MissionTranslations;
use app\modules\missions\models\Activities;
use app\modules\missions\models\ActivityTranslations;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\DifficultyLevels;
use app\modules\missions\models\EvokationCategories;
use app\modules\missions\models\EvokationCategoryTranslations;
use app\modules\missions\models\EvokationDeadline;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use app\modules\teams\models\Team;
use app\modules\missions\models\Votes;
use humhub\modules\content\models\Content;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{
    public function actionIndexDeadline()
    {
        $model = EvokationDeadline::find()->one();
        
        return $this->render('evokation-deadline/index', array('model' => $model));
    }
    
    public function actionCreateDeadline()
    {
        $model = new EvokationDeadline();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-deadline']);
        } 
        
        return $this->render('evokation-deadline/create', array('model' => $model));
    }
    
    public function actionUpdateDeadline($id)
    {
        $model = EvokationDeadline::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-deadline']);
        }

        return $this->render('evokation-deadline/update', array('model' => $model));
    }
    
    public function actionDeleteDeadline()
    {
        $model = EvokationDeadline::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-deadline']);
    }

    public function actionIndexEvidences()
    {
        $searchModel = new EvidenceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('evidences/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
    public function actionViewEvidences($id)
    {
        $model = Evidence::findOne(['id' => Yii::$app->request->get('id')]);
        return $this->render('evidences/view', array('model' => $model));
    }

    public function actionDeleteEvidences()
    {
        $model = Evidence::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->getContentObject()->delete();
        }

        return $this->redirect(['index-evidences']);
    }

    public function actionIndexReviews()
    {
        $reviews = Votes::find()->all();
        return $this->render('votes/index', array('reviews' => $reviews));
    }
    
    public function actionViewReviews($id)
    {
        $model = Votes::findOne(['id' => Yii::$app->request->get('id')]);
        return $this->render('votes/view', array('model' => $model));
    }

    public function actionUpdateQualityReviews($id)
    {
        $model = Votes::findOne(['id' => Yii::$app->request->get('id')]);

        $model->quality = Yii::$app->request->get('mark');

        if ($model->save()) {
            return $this->redirect(['view-reviews', 'id' => $model->id]);
        }

        return $this->redirect(['view-reviews', 'id' => $model->id]);
    }

    public function actionDeleteReviews()
    {
        $model = Votes::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-reviews']);
    }
    
    public function actionIndexCategories()
    {
        $categories = EvokationCategories::find()->all();
        return $this->render('evokation-categories/index', array('categories' => $categories));
    }
    
    public function actionCreateCategories()
    {
        $model = new EvokationCategories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-categories']);
        } 
        
        return $this->render('evokation-categories/create', array('model' => $model));
    }
    
    public function actionUpdateCategories()
    {
        $model = EvokationCategories::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-categories']);
        }

        return $this->render('evokation-categories/update', array('model' => $model));
    }
    
    public function actionDeleteCategories()
    {
        $model = EvokationCategories::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-categories']);
    }
    
    public function actionIndexCategoryTranslations($id)
    {
        $categories = EvokationCategoryTranslations::find()
        ->where(['evokation_category_id' => Yii::$app->request->get('id')])
        ->with('language')
        ->all();
        
        $category = EvokationCategories::findOne(['id' => Yii::$app->request->get('id')]);

        return $this->render('evokation-category-translations/index', array('categories' => $categories, 'category' => $category));
    }
    
    public function actionCreateCategoryTranslations($id)
    {
        $model = new EvokationCategoryTranslations();
        $model->evokation_category_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-category-translations', 'id' => $id]);
        } 
        
        return $this->render('evokation-category-translations/create', array('model' => $model));
    }
    
    public function actionUpdateCategoryTranslations($id)
    {
        $model = EvokationCategoryTranslations::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index-category-translations', 'id' => $id]);
        }

        return $this->render('evokation-category-translations/update', array('model' => $model));
    }
    
    public function actionDeleteCategoryTranslations()
    {
        $model = EvokationCategories::findOne(['id' => Yii::$app->request->get('id')]);

        if ($model !== null) {
            $model->delete();
        }

        return $this->redirect(['index-category-translations']);
    }
    
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

    /*
    *
    *   EVOKE ERRORS VIEW
    *
    */

    public function actionEvidencesNoContentLog(){
        $evidences = $this->getNoContentEvidences();
        return $this->render('evidences/errors', array('evidences' => $evidences));
    }

    public function actionEvidencesNoWallEntryLog(){
        $evidences = $this->getNoWallEntryEvidences();
        return $this->render('evidences/errors', array('evidences' => $evidences));
    }

    public function actionVotesNoContentLog(){
        $reviews = $this->getNoContentVotes();
        return $this->render('votes/index', array('reviews' => $reviews));
    }

    public function actionFixEvidences(){

        $this->actionFixEvidencesContents();
        $this->actionFixEvidencesWallEntries();

        return $this->redirect(['evoke-errors-view']);
    }

    public function actionFixVotes(){

        $this->actionFixVotesContents();

        return $this->redirect(['evoke-errors-view']);
    }

    private function getNoWallEntryEvidences(){
        $evidences_id = [];

        //find all corrupt ids
        $evidence_no_content_evidence = (new \yii\db\Query())
                    ->select('e.id as id')
                    ->from('evidence as e')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
                    ->join('LEFT JOIN', 'wall_entry as w', '`c`.`id` = `w`.`content_id`')
                    ->where('w.id IS NULL AND c.id IS NOT NULL')
                    ->all();

        //get only the ids
        foreach($evidence_no_content_evidence as $evidence){
            array_push($evidences_id, $evidence['id']);
        }  

        //find evidences' objects
        $evidences = Evidence::findAll(['id' => $evidences_id]);

        return $evidences;
    }

    private function getNoContentEvidences(){
        $evidences_id = [];

        //find all corrupt ids
        $evidence_no_content_evidence = (new \yii\db\Query())
                    ->select('e.id as id')
                    ->from('evidence as e')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
                    ->where('c.id IS NULL')
                    ->all();

        //get only the ids
        foreach($evidence_no_content_evidence as $evidence){
            array_push($evidences_id, $evidence['id']);
        }  

        //find evidences' objects
        $evidences = Evidence::findAll(['id' => $evidences_id]);

        return $evidences;
    }

    private function getNoContentVotes(){
        $votes_id = [];

        //find all corrupt ids
        $votes_no_content_evidence = (new \yii\db\Query())
                    ->select('v.id as id')
                    ->from('votes as v')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Votes::classname()).'\' AND `c`.`object_id` = `v`.`id`')
                    ->where('c.id IS NULL')
                    ->all();

        //get only the ids
        foreach($votes_no_content_evidence as $vote){
            array_push($votes_id, $vote['id']);
        }  

        //find votes' objects
        $votes = Votes::findAll(['id' => $votes_id]);

        return $votes;
    }

    private function actionFixVotesContents(){

        $votes = $this->getNoContentVotes();

        //fix one by one
        foreach($votes as $vote){
            $this->fixContent($vote);
        }
    }

    private function actionFixEvidencesContents(){

        $evidences = $this->getNoContentEvidences();

        //fix one by one
        foreach($evidences as $evidence){
            $this->fixContent($evidence);
        }
    }

    private function actionFixEvidencesWallEntries(){

        $contents_id = [];

        //find all corrupt ids
        $evidence_no_wall_entry_evidence = (new \yii\db\Query())
                    ->select('c.id as content_id')
                    ->from('evidence as e')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
                    ->join('LEFT JOIN', 'wall_entry as w', '`c`.`id` = `w`.`content_id`')
                    ->where('w.id IS NULL AND c.id IS NOT NULL')
                    ->all();

        //get only the ids
        foreach($evidence_no_wall_entry_evidence as $evidence){
            array_push($contents_id, $evidence['content_id']);
        }  

        //find evidences' objects
        $contents = Content::findAll(['id' => $contents_id]);

        //fix one by one
        foreach($contents as $content){
            $this->fixWallEntry($content);
        }
    }

    private function fixWallEntry($content){
        Yii::$app->db->createCommand()->insert('wall_entry', [
                "wall_id" => $content->space->wall_id, 
                "content_id" => $content->id, 
                "created_at" => $content->created_at, 
                "created_by" => $content->created_by, 
                "updated_at" => $content->updated_at, 
                "updated_by" => $content->updated_by, 
            ]
        )->execute();      
    }

    private function fixContent($object){
        $content = new Content();

        $content->object_model = $object->className();
        $content->object_id = $object->getPrimaryKey();
        $content->visibility = Content::VISIBILITY_PUBLIC;
        $content->sticked = 0;
        $content->archived = 0;

        if($object->className() == Votes::className()){
            $content->user_id = $object->user_id;
            $content->created_by = $object->user_id;
            $content->updated_by = $object->user_id;
        }else{
            $content->user_id = $object->created_by;
            $content->created_by = $object->created_by;
            $content->updated_by = $object->created_by;
        }
 
        $content->created_at = $object->created_at;
        $content->updated_at = $object->created_at;
        

        //get user's team
        $team_id = Team::getUserTeam($content->created_by);

        if($team_id){
            $content->space_id = $team_id;
        }

        //SAVE AND INSERT INTO DB

        $content->save();

        if(!$content->id){

            Yii::$app->db->createCommand()->insert('content', [
                    "guid" => $content->guid, 
                    "object_model" => $content->object_model, 
                    "object_id" => $content->object_id, 
                    "visibility" => $content->visibility, 
                    "sticked" => $content->sticked, 
                    "archived" => $content->archived, 
                    "space_id" => $content->space_id, 
                    "user_id" => $content->user_id, 
                    "created_at" => $content->created_at, 
                    "created_by" => $content->created_by, 
                    "updated_at" => $content->updated_at, 
                    "updated_by" => $content->updated_by, 
                ]
            )->execute();  

        }

        $content->addToWall();

        if ($content->space) {
            $membership = $content->space->getMembership();

            if($membership){
                $membership->updateLastVisit();    
            }
            
        }    
    }

    public function actionEvokeErrorsView(){

        $evidences_total = (new \yii\db\Query())
                    ->select('count(e.id) as count')
                    ->from('evidence as e')
                    ->one()['count'];

        $no_content_evidence = (new \yii\db\Query())
                    ->select('count(e.id) as count')
                    ->from('evidence as e')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
                    ->where('c.id IS NULL')
                    ->one()['count'];

        $evidence_no_content_percentage = $evidences_total > 0 ? $no_content_evidence / $evidences_total * 100 : 0;                    

        $no_wall_entry_evidence = (new \yii\db\Query())
                    ->select('count(e.id) as count')
                    ->from('evidence as e')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
                    ->join('LEFT JOIN', 'wall_entry as w', '`c`.`id` = `w`.`content_id`')
                    ->where('w.id IS NULL')
                    ->one()['count'];

        $evidence_no_wall_entry_percentage = $evidences_total > 0 ? $no_wall_entry_evidence / $evidences_total * 100 : 0;   

        $votes_total = (new \yii\db\Query())
                    ->select('count(v.id) as count')
                    ->from('votes as v')
                    ->one()['count'];

        $no_content_votes = (new \yii\db\Query())
                    ->select('count(v.id) as count')
                    ->from('votes as v')
                    ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Votes::classname()).'\' AND `c`.`object_id` = `v`.`id`')
                    ->where('c.id IS NULL')
                    ->one()['count'];

        $votes_no_content_percentage = $votes_total > 0 ? $no_content_votes / $votes_total * 100 : 0;                    
 

        return $this->render('evoke-errors-view', array(
            'evidences_total' => $evidences_total,
            'votes_total' => $votes_total,
            'evidence_no_content_total' => $no_content_evidence,
            'evidence_no_wall_entry_total' => $no_wall_entry_evidence,
            'votes_no_content_total' => $no_content_votes,
            'evidence_no_content_percentage' => number_format( (float) $evidence_no_content_percentage, 1, '.', '') , 
            'evidence_no_wall_entry_percentage' => number_format( (float) $evidence_no_wall_entry_percentage, 1, '.', '') ,
            'votes_no_content_percentage' => number_format( (float) $votes_no_content_percentage, 1, '.', '') , 
            )
        );
    }
    
}
