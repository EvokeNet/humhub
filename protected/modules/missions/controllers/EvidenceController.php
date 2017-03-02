<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;

use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\EvokationCategories;
use app\modules\teams\models\Team;

use humhub\modules\space\models\Membership;
use humhub\modules\space\models\Space;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;
use humhub\modules\missions\components\ContentContainerController;
use humhub\modules\admin\models\forms\MailingSettingsForm;

use app\modules\novel\models\NovelPage;
use app\modules\novel\models\Chapter;

use app\modules\missions\models\EvidenceTags;
use app\modules\missions\models\Tags;
use yii\db\Expression;

use app\modules\missions\models\TeamMission;
use app\modules\missions\models\EvokeLog;

class EvidenceController extends ContentContainerController
{

    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\missions\components\StreamAction::className(),
                'mode' => \humhub\modules\missions\components\StreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer,
                'activity_id' => Yii::$app->request->get('activity_id'),
             ),
            'userfeed' => array(
                'class' => \humhub\modules\missions\components\UserStreamAction::className(),
                'mode' => \humhub\modules\missions\components\UserStreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer
            ),
            'mentorfeed' => array(
                'class' => \humhub\modules\missions\components\MentorStreamAction::className(),
                'mode' => \humhub\modules\missions\components\MentorStreamAction::MODE_NORMAL,
                'contentContainer' => $this->contentContainer,
                'activity_id' => Yii::$app->request->get('activity_id'),
                'users_id' => Yii::$app->request->get('users_id'),
                'spaces_id' => Yii::$app->request->get('spaces_id'),
            ),
        );
    }


    public function actionActivities($missionId)
    {   
        $mission = Missions::find()
        ->where(['=', 'id', $missionId])
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();

        $previous_mission = Missions::find()
        ->andWhere(['=', 'position', $mission->position - 1])
        ->andWhere(['=', 'locked', 0])
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();

        $next_mission = Missions::find()
        ->andWhere(['=', 'position', $mission->position + 1])
        ->andWhere(['=', 'locked', 0])
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();

        $members = Membership::find()
        ->joinWith('user')
        ->where(['space_id' => $this->contentContainer->id, 'user.status' => \humhub\modules\user\models\User::STATUS_ENABLED])
        ->all();
 
        $lang = Languages::findOne(['code' => Yii::$app->language]);
        if(!isset($lang))
            $lang = Languages::findOne(['code' => 'en-US']);

        $pages = NovelPage::find()
        ->join('LEFT JOIN', 'chapter_pages', 'id = novel_id')
        ->join('LEFT JOIN', 'chapter', 'chapter_id = chapter.id')
        ->andWhere(['chapter.mission_id' => $mission->id])
        ->andWhere(['=', 'language_id', $lang->id])
        ->orderBy('page_number ASC')
        ->all();

        // $pages =  (new \yii\db\Query())
        // ->select(['n.*'])
        // ->from('novel_page as n')
        // ->join('INNER JOIN', 'chapters as c', 'n.chapter_id = `c`.`id`')
        // ->orderBy('s.page_number ASC')
        // ->all();

        return $this->render('activities', array('mission' => $mission, 'previous_mission' => $previous_mission, 'next_mission' => $next_mission, 'contentContainer' => $this->contentContainer, 'members' => $members, 'pages' => $pages));
    }

    public function actionMissions()
    {

        //$missions = Missions::find()->all();

        $missions = Missions::find()
        ->with([
            'missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])
        // ->where(['locked' => 0])
        ->orderBy('position asc')
        ->all();

        return $this->render('missions', array('missions' => $missions, 'contentContainer' => $this->contentContainer));
    }

    public function createAnimatedMessagesForPowers($activityPowers){
        if(!is_array($activityPowers)){
            $activityPowers = array($activityPowers);
        }
        foreach($activityPowers as $activity_power){
            $name = $activity_power->getPower()->title;
            if(Yii::$app->language == 'es' && isset($activity_power->getPower()->powerTranslations[0]))
                $name = $activity_power->getPower()->powerTranslations[0]->title;

            AlertController::createAlert($name, $activity_power->value, AlertController::ANIMATED, $activity_power->getPower()->image);
        }
    }

    public function getEvidenceCreatedMessage($activityPowers){

        $message_initial = "";

        //ACTIVITY MESSAGE
        $activity = Activities::findOne($activityPowers[0]->activity_id);


        if(isset($activity->activityTranslations[0])){
            if(isset($activity->activityTranslations[0]->message)){
                $message_initial = $activity->activityTranslations[0]->message;
            }
        }

        if($message_initial == "" && isset($activity->message)){
            $message_initial = $activity->message;
        }


        $message = Yii::t('MissionsModule.base', 'You just gained').' ';

        $count = 0;
        $powersTotal = count($activityPowers);

        foreach($activityPowers as $activity_power){
            $count++;

            if($count == $powersTotal - 1){
                $separator = ' '.Yii::t('MissionsModule.base', 'and').' ';
            }elseif($count < $powersTotal - 1){
                $separator = ", ";
            }else{
                $separator = ".";
            }

            if($activity_power->value > 1){
                $pointString = Yii::t('MissionsModule.base', 'points');
            }else{
                $pointString = Yii::t('MissionsModule.base', 'point');
            }

            $name = $activity_power->getPower()->title;

            if(Yii::$app->language == 'es' && isset($activity_power->getPower()->powerTranslations[0]))
                $name = $activity_power->getPower()->powerTranslations[0]->title;

            $message = $message . $activity_power->value . ' '. $pointString .' '. Yii::t('MissionsModule.base', 'in').' '. $name . $separator;
        }

        if($message_initial != ""){
            return $message_initial . "<p>" .  $message . "</p>";
        }else{
            return $message;
        }

    }

    /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionShow($activityId)
    {
        $activity = Activities::find()
        ->where(['=', 'id', $activityId])
        ->with([
            'activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();

        return $this->render('show', array(
            'contentContainer' => $this->contentContainer,
            'activity' => $activity,
            'space' => $this->space,
        ));
    }

     /**
     * Posts a new question  throu the question form
     *
     * @return type
     */
    public function actionMentor($activityId)
    {
        $activity = Activities::find()
        ->where(['=', 'id', $activityId])
        ->with([
            'activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();

        return $this->render('mentor', array(
            'contentContainer' => $this->contentContainer,
            'activity' => $activity,
            'space' => $this->space,
        ));
    }

    public function actionPublish(){
        Yii::$app->response->format = 'json';

        $user = Yii::$app->user->getIdentity();
        $id = Yii::$app->request->get('id');
        $evidence = Evidence::findOne($id);
        $request = Yii::$app->request;

        if($evidence && $evidence->content->visibility == 0 && $evidence->created_by == $user->id){

            $edited = false;
            $model = Evidence::findOne(['id' => $id]);
            $model->scenario = Evidence::SCENARIO_EDIT;

            if (!$model->content->canWrite()) {
                throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
            }

            if ($model->load($request->post())) {

                if (mb_strlen(Yii::$app->request->post('Evidence')['text']) < 140) {
                    //AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
                } else {

                    $evidence->content->visibility = 1;
                    $evidence->content->save();

                    if ($model->validate() && $model->save()) {
                        // Reload record to get populated updated_at field
                        $evidence = Evidence::findOne($id);
                        $evidence->content->visibility = 1;
                        //ACTIVITY POWER POINTS
                        $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);

                        $activity = Activities::findOne(['id' => $evidence->activities_id]);
                        $is_group_activity = $activity->is_group;

                        // find the team and its members
                          $team_id = Team::getUserTeam($user->id);
                          $team = Team::findOne($team_id);
                          $team_members = $team->getTeamMembers();

                        // if it's a group activity, we need to award points to all team members
                        if ($is_group_activity) {

                          foreach ($team_members as $team_member) {
                            $wallet = Wallet::find()->where(['owner_id' => $team_member->id])->one();
                            $wallet->addCoin(10);
                            $wallet->save();

                            foreach($activityPowers as $activity_power){
                                UserPowers::addPowerPoint($activity_power->getPower(), $team_member, $activity_power->value);
                            }
                          }
                        } else { // just award the current user
                          //USER POWER POINTS
                          foreach($activityPowers as $activity_power){
                              UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
                          }
                          //EVOCOINS
                            $wallet = Wallet::find()->where(['owner_id' => $user->id])->one();
                            $wallet->addCoin(10);
                            $wallet->save();
                        }

                        //evidence evocoin reward
                        AlertController::createAlert(Yii::t('MissionsModule.base', "Reward"), Yii::t('MissionsModule.base', 'You\'ve received 10 evocoins for this evidence.'));

                        $evidence->content->save();

                         //MISSION COMPLETION EVOCOINS                
                        if(!TeamMission::isMissionCompleted($activity->mission_id, $team->id)){
                            $mission = Missions::findOne($activity->mission_id);
                            $hasTeamCompletedMission = $mission->hasTeamCompleted($team->id);
                            if($hasTeamCompletedMission){
                                foreach ($team_members as $team_member) {
                                    $wallet = Wallet::find()->where(['owner_id' => $team_member->id])->one();
                                    $wallet->addCoin(100);
                                    $wallet->save();
                                }

                                $team_mission = new TeamMission();
                                $team_mission->space_id = $team->id;
                                $team_mission->mission_id = $mission->id;
                                $team_mission->created_at = new Expression('NOW()');
                                $team_mission->updated_at = new Expression('NOW()');
                                $team_mission->save();

                                AlertController::createAlert(Yii::t('MissionsModule.base', "Reward"), Yii::t('MissionsModule.base', 'You\'ve received 100 evocoins for completing this mission.'));
                            }
                        }

                        //old popup
                        //$message = $this->getEvidenceCreatedMessage($activityPowers);
                        //AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), $message);

                        $this->createAnimatedMessagesForPowers($activityPowers);

                        return array('wallEntryId' => $evidence->content->getFirstWallEntryId());

                    } else {
                        $evidence->content->visibility = 0;
                        $evidence->content->save();

                        AlertController::sendDefaultErrorMessage();
                        return "error";
                    }
                }
            }

        }else{
            AlertController::sendDefaultErrorMessage();
            return "error";
        }
    }

    public function actionDraft(){
        if (!$this->contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence())) {
            throw new HttpException(400, 'Access denied!');
        }

        $evidence = new Evidence();
        $evidence->scenario = Evidence::SCENARIO_CREATE;
        $evidence->title = Yii::$app->request->post('title');
        $evidence->text = Yii::$app->request->post('text');
        $evidence->activities_id = Yii::$app->request->post('activityId');

        if(!Yii::$app->request->post('title')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Title cannot be blank.'));
        } else if(!Yii::$app->request->post('text')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Text cannot be blank.'));
        } else{
            AlertController::createAlert(Yii::t('MissionsModule.base', 'Draft saved!'),Yii::t('MissionsModule.base', 'Your evidence\'s draft has been saved!'));
        }

        return \humhub\modules\missions\widgets\WallCreateForm::create($evidence, $this->contentContainer, true);
    }

    /**
     * Posts a new question  throws the question form
     *
     * @return type
     */
    public function actionCreate()
    {
        if (!$this->contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence())) {
            throw new HttpException(400, 'Access denied!');
        }

        $evidence = new Evidence();
        $evidence->scenario = Evidence::SCENARIO_CREATE;
        $evidence->title = Yii::$app->request->post('title');
        $evidence->text = Yii::$app->request->post('text');
        $evidence->activities_id = Yii::$app->request->post('activityId');

        Yii::$app->response->format = 'json';

        if(!Yii::$app->request->post('title')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Title cannot be blank.'));
            return array('errors' => []);
        } else if(!Yii::$app->request->post('text')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Text cannot be blank.'));
            return array('errors' => []);
        } else if (mb_strlen(Yii::$app->request->post('text')) < 140) {
          AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
            return array('errors' => []);
        } else{

            //ACTIVITY POWER POINTS
            $activityPowers = ActivityPowers::find()->where(['activity_id' => $evidence->activities_id])->orderBy('flag ASC')->all();
            $user = Yii::$app->user->getIdentity();
            $activity = Activities::findOne(['id' => $evidence->activities_id]);

            $is_group_activity = $activity->is_group;

            // find the team and it's members
            $team_id = Team::getUserTeam($user->id);
            $team = Team::findOne($team_id);
            $team_members = $team->getTeamMembers();

            // if it's a group activity, we need to award points to all team members
            if ($is_group_activity) {

              foreach ($team_members as $team_member) {

                $wallet = Wallet::find()->where(['owner_id' => $team_member->id])->one();
                $wallet->addCoin(10);
                $wallet->save();

                foreach($activityPowers as $activity_power){
                    UserPowers::addPowerPoint($activity_power->getPower(), $team_member, $activity_power->value);
                }
              }
            } else { // just award the current user
              //USER POWER POINTS
              foreach($activityPowers as $activity_power){
                  UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
              }

              //STANDARD EVOCOINS
                $wallet = Wallet::find()->where(['owner_id' => $user->id])->one();
                $wallet->addCoin(10);
                $wallet->save();
            }

            //evidence evocoin reward
            AlertController::createAlert(Yii::t('MissionsModule.base', "Reward"), Yii::t('MissionsModule.base', 'You\'ve received 10 evocoins for this evidence.'));
            

            //MISSION COMPLETION EVOCOINS                

            if(!TeamMission::isMissionCompleted($activity->mission_id, $team->id)){
                $mission = Missions::findOne($activity->mission_id);
                $isTeamGoingToComplete = $mission->isTeamGoingToComplete($team->id, $activity->id);
                if($isTeamGoingToComplete){
                    foreach ($team_members as $team_member) {
                        $wallet = Wallet::find()->where(['owner_id' => $team_member->id])->one();
                        $wallet->addCoin(100);
                        $wallet->save();
                    }

                    $team_mission = new TeamMission();
                    $team_mission->space_id = $team->id;
                    $team_mission->mission_id = $mission->id;
                    $team_mission->created_at = new Expression('NOW()');
                    $team_mission->updated_at = new Expression('NOW()');
                    $team_mission->save();

                    AlertController::createAlert(Yii::t('MissionsModule.base', "Reward"), Yii::t('MissionsModule.base', 'You\'ve received 100 evocoins for completing this mission.'));
                }
            }

            //EvokeLog

                $log['id'] = 'evidence_submitting';
                $log['user'] = $user->username;
                $log['user_real_name'] = $user->getName();
                $log['earned_evocoins_by_author'] = 10;
                $log['evidence_activity'] = $activity->id_code;

                if($is_group_activity){
                    $log['team'] = $team->name;
                    foreach ($team_members as $team_member) {  
                        foreach($activityPowers as $activity_power){
                            $log[$activity_power->getPower()->title.'_'.$team_member->username."_points"] = $activity_power->value;
                        }                      
                    }
                }else{
                    foreach($activityPowers as $activity_power){
                        $log[$activity_power->getPower()->title."_evidence_author_points"] = $activity_power->value;
                    }
                }

                if($isTeamGoingToComplete){
                    foreach ($team_members as $team_member) {
                        $log[$activity_power->getPower()->title.'_'.$team_member->username."_earned_extra_evocoins"] = 100;
                    }
                }

                EvokeLog::log($log);

            //END EVOKE LOG

            //old popup
            //$message = $this->getEvidenceCreatedMessage($activityPowers);
            //AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), $message);

            $this->createAnimatedMessagesForPowers($activityPowers);

        }

        return \humhub\modules\missions\widgets\WallCreateForm::create($evidence, $this->contentContainer, false);
    }

    public function actionUpdate()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');

        $edited = false;
        $model = Evidence::findOne(['id' => $id]);
        $model->scenario = Evidence::SCENARIO_EDIT;

        if (!$model->content->canWrite()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }

        if ($model->load($request->post())) {

            if ($model->validate() && $model->save()) {
                // Reload record to get populated updated_at field
                $model = Evidence::findOne(['id' => $id]);
                AlertController::createAlert(Yii::t('MissionsModule.base', 'Draft saved!'),Yii::t('MissionsModule.base', 'Your evidence\'s draft has been saved!'));
            } else {
                AlertController::sendDefaultErrorMessage();
            }

        }
    }


   public function actionEdit()
    {

        $request = Yii::$app->request;
        $id = $request->get('id');

        $edited = false;
        $model = Evidence::findOne(['id' => $id]);
        $model->scenario = Evidence::SCENARIO_EDIT;

        if (!$model->content->canWrite()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }


        if ($model->load($request->post())) {

            Yii::$app->response->format = 'json';
            $result = [];

            if (mb_strlen(Yii::$app->request->post('Evidence')['text']) < 140) {

                AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
                $result['errors'] = $model->getErrors();
                return $result;

            } else {
                if ($model->validate() && $model->save()) {
                    // Reload record to get populated updated_at field
                    $model = Evidence::findOne(['id' => $id]);
                    $result['success'] = true;
                    $result['output'] = $this->renderAjaxContent($model->getWallOut(['justEdited' => true]));
                } else {
                    $result['errors'] = $model->getErrors();
                }
                return $result;
            }
        }

        return $this->renderAjax('edit', ['evidence' => $model, 'edited' => $edited]);
    }

    /**
     * Reloads a single entry
     */
    public function actionReload()
    {
        $id = Yii::$app->request->get('id');
        $model = Evidence::findOne(['id' => $id]);

        if (!$model->content->canRead()) {
            throw new HttpException(403, Yii::t('MissionsModule.controllers_PollController', 'Access denied!'));
        }

        return $this->renderAjaxContent($model->getWallOut(['justEdited' => true]));
    }

    public function actionReview(){
        $user = Yii::$app->user->getIdentity();

        $flag = Yii::$app->request->get("opt") == "no" ? 0 : 1;
        $grade = Yii::$app->request->get("grade");
        $comment = Yii::$app->request->get("comment");
        $evidenceId = Yii::$app->request->get("evidenceId");
        $tags = Yii::$app->request->get("tags");
        $evidence = $evidenceId ? Evidence::findOne($evidenceId) : null;
        $evocoin_earned = 0;

        $vote = Votes::findOne(['user_id' => $user->id, 'evidence_id' => $evidenceId]);

        if (empty($comment) && $user->group->name == "Mentors") {
            //mentors must comment
            AlertController::sendDefaultErrorMessage();
            return;
        }

        /*
        if (!empty($comment) && mb_strlen($comment) < 140) {
            //comments must be at least 140 characters long
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
            return;
        }
        */

        /*
            Check if review is valid:
            *** - it has a 'no' vote or a 1-5 'yes' vote
            *** - it has an evidence id associated
            *** - evidence author isn't the same user who's reviewing
        */
        if(($flag == 0 || $grade >= 1) && $evidenceId && $evidence->content->user_id != $user->id){

            if (empty($comment) && $flag == 0) {
                //must leave comment if giving a grade of 0
                AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Please explain 0'));
                return;
            }

            $author = User::findOne($evidence->content->user_id);

            $is_group_activity = Activities::findOne(['id' => $evidence->activities_id])->is_group;

            //if user's editing vote
            if($vote){
                $pointChange = $grade - $vote->value;

                // mentor votes are worth twice as much
                if ($user->group->name == "Mentors") {
                    $pointChange = $pointChange * 2;
                }

                if(empty($vote->comment) && !empty($comment)){

                    $wallet = Wallet::find()->where(['owner_id' => $user->id])->one();
                    $wallet->addCoin(4);
                    $evocoin_earned += 4;
                    $wallet->save();
                }else if(!empty($vote->comment) && empty($comment)){
                    $comment = $vote->comment;
                }

                $vote->flag = $flag;
                $vote->comment = $comment;
                $vote->value = $grade;
                $vote->save();

                //updated evidence author's reward
                $activityPower = Activities::findOne($vote->activity_id)->getPrimaryPowers()[0];

                // if it's a group activity, we need to award points to all team members
                if ($is_group_activity) {
                  // find the team and it's members
                  $team_id = Team::getUserTeam($author->id);
                  $team = Team::findOne($team_id);
                  $team_members = $team->getTeamMembers();

                  foreach ($team_members as $team_member) {
                    UserPowers::addPowerPoint($activityPower->getPower(), $team_member, $pointChange);
                  }
                } else { // just award the current user
                  //USER POWER POINTS
                  UserPowers::addPowerPoint($activityPower->getPower(), $author, $pointChange);
                }

                if($evocoin_earned <= 0){
                    AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', 'Your review was updated!'));
                }else{
                    $message = Yii::t('MissionsModule.base', 'You just gained {message} evocoins!', array('message' => $evocoin_earned));
                    AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', '{message}. <BR>Thank you for your review.', array('message' => $message)));
                }
                echo $this->renderPartial('..\..\widgets\views\user_vote_view.php', array('vote' => $vote, 'contentContainer' => $this->contentContainer));

            }else{

                //SAVE VOTE
                $vote = new Votes();
                $vote->user_id = $user->id;
                $vote->activity_id = $evidence->activities_id;
                $vote->evidence_id = $evidenceId;
                $vote->comment = $comment;
                $vote->flag = $flag;
                $vote->value = $grade;
                $vote->user_type = $user->group->name;
                $vote->save();

                //SAVE TAGS

                $all_tags_used = ''; //Variable to get all tags used and 

                if($tags){
                    foreach($tags as $key => $tag_id){
                        $tag = new EvidenceTags();    
                        $tag->tag_id = $tag_id;
                        $tag->evidence_id = $evidenceId;
                        $tag->user_id = $user->id;
                        $tag->created_at = new Expression('NOW()');
                        $tag->updated_at = new Expression('NOW()');
                        $tag->save();

                        $search_tag = Tags::find()->where(['id' => $tag_id])->one()->title;
                        
                        if($key == 0)
                            $all_tags_used .= $search_tag;
                        else
                            $all_tags_used .= ', '.$search_tag;
                    }
                } 

                $evocoin_earned = 0;

                //Reward reviewer 1 evocoin
                $wallet = Wallet::find()->where(['owner_id' => $user->id])->one();
                $wallet->addCoin(1);
                $evocoin_earned += 1;

                //give an extra 4 for adding a comment
                if (!empty($comment)) {
                    $wallet->addCoin(4);
                    $evocoin_earned += 4;
                }

                $wallet->save();

                $activityPower = Activities::findOne($vote->activity_id)->getPrimaryPowers()[0];

                //Reward evidence author
                if($flag){
                    if ($user->group->name == "Mentors") {
                        $grade *= 2;
                    }

                    // if it's a group activity, we need to award points to all team members
                    if ($is_group_activity) {
                      // find the team and it's members
                      $team_id = Team::getUserTeam($author->id);
                      $team = Team::findOne($team_id);
                      $team_members = $team->getTeamMembers();

                      foreach ($team_members as $team_member) {
                        UserPowers::addPowerPoint($activityPower->getPower(), $team_member, $grade);
                      }
                    } else { // just award the current user
                      //USER POWER POINTS
                      UserPowers::addPowerPoint($activityPower->getPower(), $author, $grade);
                    }
                }


                //EvokeLog

                $log['id'] = 'review'; 
                $log['reviewer_username'] = $user->username;
                $log['reviewer_real_name'] = $user->getName();
                $log['group'] = $user->group->name;
                $log['earned_evocoins_by_reviewer'] = $evocoin_earned;
                $log['evidence_url'] = $evidence->content->getUrl();
                $log['evidence_activity'] = $evidence->activities->id_code;
                $log['evidence_author_username'] = $evidence->getAuthor()->username;
                $log['evidence_author_real_name'] = $evidence->getAuthor()->getName();
                $log['tags_selected'] = $all_tags_used;

                if($is_group_activity){
                    $log['team'] = $team->name;
                    foreach ($team_members as $team_member) {
                        $log[$activity_power->getPower()->title.'_'.$team_member->username."_points"] = $grade;                        
                    }
                }else{
                    $log[$activity_power->getPower()->title."_evidence_author_points"] = $grade;
                }

                EvokeLog::log($log);

                //END EVOKE LOG

                $message = Yii::t('MissionsModule.base', 'You just gained {message} evocoins!', array('message' => $evocoin_earned));

                AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', '{message}. <BR>Thank you for your review.', array('message' => $message)));
                
                Votes::checkFiveTaggedEvidencesReward();

                echo $this->renderPartial('..\..\widgets\views\user_vote_view.php', array('vote' => $vote, 'contentContainer' => $this->contentContainer));
            }
        } else{
            AlertController::sendDefaultErrorMessage();
        }

    }

    public function actionTag(){
        $user = Yii::$app->user->getIdentity();
        $evidenceId = Yii::$app->request->get("evidenceId");
        $tags = Yii::$app->request->get("tags");
        $evidence = $evidenceId ? Evidence::findOne($evidenceId) : null;
        $evocoin_earned = 0;

        $all_tags_used = '';

        //Save Tags
        if($tags){
            foreach($tags as $key => $tag_id){
                $tag = new EvidenceTags();    
                $tag->tag_id = $tag_id;
                $tag->evidence_id = $evidenceId;
                $tag->user_id = $user->id;
                $tag->created_at = new Expression('NOW()');
                $tag->updated_at = new Expression('NOW()');
                $tag->save();

                $search_tag = Tags::find()->where(['id' => $tag_id])->one()->title;
                        
                if($key == 0)
                    $all_tags_used .= $search_tag;
                else
                    $all_tags_used .= ', '.$search_tag;

            }
        }

        if(Votes::checkFiveTaggedEvidencesReward()){
            $evocoin_earned += 1;    
        }


        //EvokeLog

                $log['id'] = 'tagging'; 
                $log['tagger_username'] = $user->username;
                $log['tagger_real_name'] = $user->getName();
                $log['earned_evocoins_by_tagger'] = $evocoin_earned;
                $log['evidence_url'] = $evidence->content->getUrl();
                $log['evidence_activity'] = $evidence->activities->id_code;
                $log['evidence_author_username'] = $evidence->getAuthor()->username;
                $log['evidence_author_real_name'] = $evidence->getAuthor()->getName();
                $log['tags_selected'] = $all_tags_used;

                EvokeLog::log($log);

        //END EVOKE LOG

        AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', 'Thank you for tagging this evidence'));
    }

    public function actionEdit_review(){
        $evidence_id = Yii::$app->request->get("id");
        $evidence = Evidence::findOne($evidence_id);
        if($evidence){
            $activity = $evidence->getActivities();
            if(Yii::$app->user->getIdentity()->group->name == "Mentors"){
                echo $this->renderPartial('..\..\widgets\views\mentor_review.php', array('evidence' => $evidence, 'activity' => $activity), true, false);  
            }    
        }
        
    }

     /**
    * Custom actions
    */
    public function actionMentor_activities()
    {
        $categories = EvokationCategories::find()
        ->with([
            'activities.mission.missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'activities.activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            // 'activities.evidences' => function($query){
            //     $query->andWhere([$this->contentContainer->id]);
            // }
        ])->all();

        $missions = Missions::find()
        ->where(['locked' => 0])
        ->all();

        return $this->render('mentor_activities', array('categories' => $categories, 'missions' => $missions, 'contentContainer' => $this->contentContainer));
    }



}
