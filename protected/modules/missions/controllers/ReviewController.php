<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use humhub\modules\file\models\File;

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
use app\modules\missions\models\Votes;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;

class ReviewController extends ContentContainerController
{

    public function actions()
    {

    }   

   
    public function actionIndex()
    {   
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
        ->one();

        if($query && array_key_exists('id', $query)){
            $evidence_id = $query['id'];

            $evidence = Evidence::findOne($evidence_id);
            $files = File::findAll(array('object_model' => Evidence::classname(), 'object_id' => $evidence_id));
        }

        return $this->render('index', array('contentContainer' => $this->contentContainer, 'evidence' => $evidence, 'files' => $files));
    }

}
