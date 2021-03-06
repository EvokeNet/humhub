<?php

namespace humhub\modules\teams\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\HttpException;
use humhub\components\Controller;
use humhub\modules\space\models;
use humhub\models\Setting;
use humhub\modules\space\models\Space;
use humhub\modules\space\permissions\CreatePublicSpace;
use humhub\modules\space\permissions\CreatePrivateSpace;
use humhub\modules\missions\controllers\AlertController;
use app\modules\teams\models\Team;


class CreateController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => \humhub\components\behaviors\AccessControl::className(),
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->redirect(Url::to(['create']));
    }

    public function actionCreate_team(){
        $team_id = Team::getUserTeam(Yii::$app->user->getIdentity()->id);
        if(!isset($team_id)){
            return $this->actionCreate(true);    
        }else{
            return $this->actionCreate();  
        }
        
    }

    /**
     * Creates a new Space
     */
    public function actionCreate($teamChecked = "")
    {
        $user = Yii::$app->user->getIdentity();

        // User cannot create spaces (public or private)
        if (!Yii::$app->user->permissionmanager->can(new CreatePublicSpace) && !Yii::$app->user->permissionmanager->can(new CreatePrivateSpace())) {
            throw new HttpException(400, 'You are not allowed to create spaces!');
        }

        $model = $this->createTeamModel();

        if($teamChecked){
            $model->is_team = 1;
        }

        if($user->group->name == "Mentors"){
            $model->is_team = 0;
        }

        $createTeamsPermission = !(Team::isMemberOfATeam(Yii::$app->user->id));

        $data = [];

        if(Yii::$app->request->post()){
            $model = $this->createSpaceModel();
            $data = Yii::$app->request->post();

            if(null !== Yii::$app->request->post('Team')){
                $data['Space'] = $data['Team'];    
            }
            
            unset($data['Team']);
        }

        if ($model->load($data) && $model->validate() && $model->save()) {

            if($createTeamsPermission){
                $teamModel = Team::findOne($model->id);
                $teamModel->is_team = $data['Space']['is_team'];
                $teamModel->save();
            }

            return $this->actionModules($model->id);
        }else{
            if($teamChecked){
                $model->is_team = 1;
            }
        }


        $visibilityOptions = [];
        if (Setting::Get('allowGuestAccess', 'authentication_internal') && Yii::$app->user->permissionmanager->can(new CreatePublicSpace)) {
            $visibilityOptions[Space::VISIBILITY_ALL] = Yii::t('SpaceModule.base', 'Public (Members & Guests)');
        }
        if (Yii::$app->user->permissionmanager->can(new CreatePublicSpace)) {
            $visibilityOptions[Space::VISIBILITY_REGISTERED_ONLY] = Yii::t('SpaceModule.base', 'Public (Members only)');
        }
        if (Yii::$app->user->permissionmanager->can(new CreatePrivateSpace())) {
            $visibilityOptions[Space::VISIBILITY_NONE] = Yii::t('SpaceModule.base', 'Private (Invisible)');
        }
        
        $joinPolicyOptions = [
            Space::JOIN_POLICY_NONE => Yii::t('SpaceModule.base', 'Only by invite'),
            Space::JOIN_POLICY_APPLICATION => Yii::t('SpaceModule.base', 'Invite and request'),
            Space::JOIN_POLICY_FREE => Yii::t('SpaceModule.base', 'Everyone can enter')
        ];

        return $this->renderAjax('create', ['model' => $model, 'visibilityOptions' => $visibilityOptions, 'joinPolicyOptions' => $joinPolicyOptions, 'createTeamsPermission' => $createTeamsPermission]);
    }

    /**
     * Activate / deactivate modules
     */
    public function actionModules($space_id)
    {
        $space = Space::find()->where(['id' => $space_id])->one();

        if (count($space->getAvailableModules()) == 0) {

            $model = new \humhub\modules\space\models\forms\InviteForm();
            $model->space = $space;

            return $this->renderAjax('invite', ['spaceId' => $space->id, 'model' => $model, 'space' => $space]);
        } else {
            return $this->renderAjax('modules', ['space' => $space, 'availableModules' => $space->getAvailableModules()]);
        }
    }

    /**
     * Invite user
     */
    public function actionInvite()
    {

        $space = Space::find()->where(['id' => Yii::$app->request->get('spaceId', "")])->one();

        $model = new \humhub\modules\space\models\forms\InviteForm();
        $model->space = $space;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            // Invite existing members
            foreach ($model->getInvites() as $user) {
                $space->inviteMember($user->id, Yii::$app->user->id);
            }
            // Invite non existing members
            if (Setting::Get('internalUsersCanInvite', 'authentication_internal')) {
                foreach ($model->getInvitesExternal() as $email) {
                    $space->inviteMemberByEMail($email, Yii::$app->user->id);
                }
            }

            return $this->htmlRedirect($space->getUrl());
        }

        return $this->renderAjax('invite', array('model' => $model, 'space' => $space));
    }

    /**
     * Cancel Space creation
     */
    public function actionCancel()
    {

        $space = Space::find()->where(['id' => Yii::$app->request->get('spaceId', "")])->one();
        $space->delete();
    }

    /**
     * Creates an empty space model
     * 
     * @return Space
     */
    protected function createSpaceModel()
    {
        $model = new Space();
        $model->scenario = 'create';
        $model->visibility = Setting::Get('defaultVisibility', 'space');
        $model->join_policy = Setting::Get('defaultJoinPolicy', 'space');
        return $model;
    }

    protected function createTeamModel()
    {
        $model = new Team();
        $model->scenario = 'create';
        $model->visibility = Setting::Get('defaultVisibility', 'space');
        $model->join_policy = Setting::Get('defaultJoinPolicy', 'space');
        $model->is_team = -1;
        return $model;
    }

}

?>
