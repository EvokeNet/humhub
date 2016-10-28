<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use humhub\modules\file\models\File;
use yii\helpers\Json;
use humhub\modules\content\components\ContentContainerController;
use app\modules\teams\models\Team;
use humhub\modules\space\models\Membership;
use humhub\modules\space\models\Space;
use yii\web\HttpException;

class ReviewController extends ContentContainerController
{

    //Overwrite
    public function checkAccess(){
        if (\humhub\models\Setting::Get('allowGuestAccess', 'authentication_internal') && Yii::$app->user->isGuest && $this->space->visibility != Space::VISIBILITY_ALL) {
            throw new HttpException(401, Yii::t('SpaceModule.behaviors_SpaceControllerBehavior', 'You need to login to view contents of this space!'));
        }

        // Save users last action on this space
        $membership = $this->space->getMembership(Yii::$app->user->id);

        if ($membership != null && $membership->status == Membership::STATUS_MEMBER) {
            $membership->updateLastVisit();
        } else {

            // Super Admin can always enter
            if (!Yii::$app->user->isAdmin()) {
                // Space invisible?
                if ($this->space->visibility == Space::VISIBILITY_NONE) {
                    // Not Space Member
                    // Redirect to request access page
                    Yii::$app->response->redirect($this->contentContainer->createUrl('/missions/membership/contact'));
                }
            }
        }
    }

    public function actions()
    {

    }

    public function getEvidenceToReviewCount($currentSpace){

        $user_id = Yii::$app->user->getIdentity()->id;

        $team_id = Team::getUserTeam($user_id);

        $query = (new \yii\db\Query())
        ->select(['count(distinct e.id) as count'])
        ->from('evidence as e')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        //->join('LEFT JOIN', 'space_membership s', '`s`.`user_id`=`c`.`user_id`')
        //->where('s.space_id != '.$team_id)
        ->where('c.space_id != '.$currentSpace->id)
        ->andWhere('c.user_id != '.$user_id)
        ->one();

        return $query['count'];
    }

    public function getNextEvidence($currentSpace){
        $nextEvidence = array();
        $evidence = null;
        $files = null;
        $user_id = Yii::$app->user->getIdentity()->id;

        $team_id = Team::getUserTeam($user_id);

        $subquery = '(SELECT v2.evidence_id from votes as v2 where v2.user_id = '.Yii::$app->user->getIdentity()->id.')';

        $query = (new \yii\db\Query())
        ->select(['e.id as id, count(distinct v.id) as vote_count'])
        ->from('evidence as e')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->join('LEFT JOIN', 'votes v', '`v`.`evidence_id`=`e`.`id`')
        //->join('LEFT JOIN', 'space_membership s', '`s`.`user_id`=`c`.`user_id`')
        ->where('c.space_id != '.$currentSpace->id)
        ->andWhere('e.id NOT IN  '.$subquery)
        ->andWhere('c.user_id != '.$user_id)
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
        $user = Yii::$app->user->getIdentity();

        $nextEvidence = $this->getNextEvidence($this->contentContainer);
        $evidence = $nextEvidence['evidence'];
        $files = $nextEvidence['files'];
        $evidence_to_review_count = $nextEvidence['evidence_to_review_count'];
        $totalEvidence = $this->getEvidenceToReviewCount($this->contentContainer);

        if($this->contentContainer->name == "Mentors" && $user->group->name != "Mentors"){
            $this->redirect($this->contentContainer->createUrl());
        }

        return $this->render('index', array('contentContainer' => $this->contentContainer, 'evidence' => $evidence, 'files' => $files, 'evidence_count' => $totalEvidence, 'evidence_to_review_count' => $evidence_to_review_count));
    }

    public function actionShow($id)
    {
        $user = Yii::$app->user->getIdentity();

        $evidence = Evidence::findOne($id);
        $files = File::findAll(array('object_model' => Evidence::classname(), 'object_id' => $evidence->id));

        if($this->contentContainer->name == "Mentors" && $user->group->name != "Mentors"){
            $this->redirect($this->contentContainer->createUrl());
        }

        return $this->render('show', array('contentContainer' => $this->contentContainer, 'evidence' => $evidence, 'files' => $files));
    }

    public function actionList()
    {
        $user = Yii::$app->user->getIdentity();

        $teams = Team::getTeamsFollowed($user->id);

        return $this->render('list', array('contentContainer' => $this->contentContainer, 'teams' => $teams));
    }

}
