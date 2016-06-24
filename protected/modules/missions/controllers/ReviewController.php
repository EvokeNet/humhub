<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use humhub\modules\file\models\File;
use yii\helpers\Json;
use humhub\modules\content\components\ContentContainerController;

class ReviewController extends ContentContainerController
{

    public function actions()
    {

    }   

    public function getEvidenceToReviewCount(){

        $query = (new \yii\db\Query())
        ->select(['s.space_id as space_id'])
        ->from('space_membership as s')
        ->where(['user_id' => Yii::$app->user->getIdentity()->id])
        ->one();
        
        $user_space_id = $query['space_id'];

        $query = (new \yii\db\Query())
        ->select(['count(distinct e.id) as count'])
        ->from('evidence as e')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('LEFT JOIN', 'space_membership s', '`s`.`user_id`=`c`.`user_id`')
        ->where('s.space_id != '.$user_space_id)
        ->one();

        return $query['count'];
    }

    public function getNextEvidence(){
        $nextEvidence = array();
        $evidence = null;
        $files = null;

        $query = (new \yii\db\Query())
        ->select(['s.space_id as space_id'])
        ->from('space_membership as s')
        ->where(['user_id' => Yii::$app->user->getIdentity()->id])
        ->one();
        
        $user_space_id = $query['space_id'];

        $subquery = '(SELECT v2.evidence_id from votes as v2 where v2.user_id = '.Yii::$app->user->getIdentity()->id.')';

        $query = (new \yii\db\Query())
        ->select(['e.id as id, count(distinct v.id) as vote_count'])
        ->from('evidence as e')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('LEFT JOIN', 'votes v', '`v`.`evidence_id`=`e`.`id`')
        ->join('LEFT JOIN', 'space_membership s', '`s`.`user_id`=`c`.`user_id`')
        ->where('s.space_id != '.$user_space_id.' AND e.id NOT IN '.$subquery)
        ->groupBy('e.id')
        ->orderBy('vote_count ASC')
        ->All();

        $nextEvidence['evidence_to_review_count'] = sizeof($query);
        if($query)
        $query = $query[0];

        if($query && array_key_exists('id', $query)){
            $evidence_id = $query['id'];

            $evidence = Evidence::findOne($evidence_id);
            $files = File::findAll(array('object_model' => Evidence::classname(), 'object_id' => $evidence_id));
        }
        $nextEvidence['evidence'] = $evidence;
        $nextEvidence['files'] = $files;
        

        return $nextEvidence;
    }

    public function actionQueue(){

        $nextEvidence = $this->getNextEvidence();
        $nextEvidence['activity'] =  $nextEvidence['evidence']->getActivities();  

        header('Content-Type: application/json; charset="UTF-8"');
        $nextEvidence = Json::encode($nextEvidence);
        echo $nextEvidence;
        Yii::$app->end();
    }
   
    public function actionIndex()
    {   
        $nextEvidence = $this->getNextEvidence();
        $evidence = $nextEvidence['evidence'];
        $files = $nextEvidence['files'];
        $evidence_to_review_count = $nextEvidence['evidence_to_review_count'];
        $totalEvidence = $this->getEvidenceToReviewCount();

        return $this->render('index', array('contentContainer' => $this->contentContainer, 'evidence' => $evidence, 'files' => $files, 'evidence_count' => $totalEvidence, 'evidence_to_review_count' => $evidence_to_review_count));
    }

}
