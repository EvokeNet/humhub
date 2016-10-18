<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\EvidenceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\filters\VerbFilter;
use humhub\modules\missions\components\ContentContainerController;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\EvokationCategories;

use humhub\modules\space\models\Membership;
use humhub\modules\space\models\Space;

use humhub\modules\admin\models\forms\MailingSettingsForm;

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

        $members = Membership::find()
        ->joinWith('user')
        ->where(['space_id' => $this->contentContainer->id, 'user.status' => \humhub\modules\user\models\User::STATUS_ENABLED])
        ->all();

        return $this->render('activities', array('mission' => $mission, 'contentContainer' => $this->contentContainer, 'members' => $members));
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
        ->all();

        return $this->render('missions', array('missions' => $missions, 'contentContainer' => $this->contentContainer));
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

                if (strlen(Yii::$app->request->post('Evidence')['text']) < 140) {
                    AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
                } else {
                    if ($model->validate() && $model->save()) {
                        // Reload record to get populated updated_at field
                        $evidence = Evidence::findOne($id);
                        $evidence->content->visibility = 1;
                        $evidence->content->save();
                        //ACTIVITY POWER POINTS
                        $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);

                        //USER POWER POINTS
                        foreach($activityPowers as $activity_power){
                            UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
                        }

                        $message = $this->getEvidenceCreatedMessage($activityPowers);
                        AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), $message);

                        $this->redirect($evidence->content->getUrl());

                    } else {
                        AlertController::createAlert(Yii::t('MissionsModule.base', 'Error'),Yii::t('MissionsModule.base', 'Something went wrong.'));
                    }
                }
            }

        }else{
            AlertController::createAlert(Yii::t('MissionsModule.base', 'Error!'), "Something's wrong");
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

        if(!Yii::$app->request->post('title')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Title cannot be blank.'));
        } else if(!Yii::$app->request->post('text')){
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Text cannot be blank.'));
        } else if (strlen(Yii::$app->request->post('text')) < 140) {
          AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
        } else{

            //ACTIVITY POWER POINTS
            $activityPowers = ActivityPowers::findAll(['activity_id' => $evidence->activities_id]);
            $user = Yii::$app->user->getIdentity();

            //USER POWER POINTS
            foreach($activityPowers as $activity_power){
                UserPowers::addPowerPoint($activity_power->getPower(), $user, $activity_power->value);
            }

            $message = $this->getEvidenceCreatedMessage($activityPowers);
            AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), $message);

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
                AlertController::createAlert(Yii::t('MissionsModule.base', 'Error'),Yii::t('MissionsModule.base', 'Something went wrong.'));
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

            if (strlen(Yii::$app->request->post('Evidence')['text']) < 140) {

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
        $evidence = $evidenceId ? Evidence::findOne($evidenceId) : null;
        $evocoin_earned = 0;

        $vote = Votes::findOne(['user_id' => $user->id, 'evidence_id' => $evidenceId]);

        if (empty($comment) && $user->group->name == "Mentors") {
            //mentors must comment
            AlertController::createAlert("Error", "Oops! Something's wrong.");
            return;
        }

        if (!empty($comment) && strlen($comment) < 140) {
            //comments must be at least 140 characters long
            AlertController::createAlert("Error!", Yii::t('MissionsModule.base', 'Post too short.'));
            return;
        }

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
                UserPowers::addPowerPoint($activityPower->getPower(), User::findOne($evidence->content->user_id), $pointChange);

                if($evocoin_earned <= 0){
                    AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', 'Your review was updated!'));
                }else{
                    $message = Yii::t('MissionsModule.base', 'You just gained {message} evocoins!', array('message' => $evocoin_earned));
                    AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', '{message}. <BR>Thank you for your review.', array('message' => $message)));
                }


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
                    UserPowers::addPowerPoint($activityPower->getPower(), User::findOne($evidence->content->user_id), $grade);
                }

                $message = Yii::t('MissionsModule.base', 'You just gained {message} evocoins!', array('message' => $evocoin_earned));

                AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', '{message}. <BR>Thank you for your review.', array('message' => $message)));
            }
        } else{
            AlertController::createAlert("Error", "Oops! Something's wrong.");
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
