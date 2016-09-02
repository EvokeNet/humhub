<?php

namespace humhub\modules\missions\controllers;

use Yii;
use humhub\components\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\web\HttpException;
use humhub\modules\space\models\Space;
use humhub\modules\space\models\Membership;
use humhub\modules\space\models\forms\RequestMembershipForm;

class MembershipController extends Controller
{
    public function actionContact(){
        $space = Space::findOne(['guid' => Yii::$app->request->get('sguid')]);
        $membership = Membership::findOne(['user_id' => Yii::$app->user->id, 'space_id' => $space->id]);
        return $this->render('contact', ['space' => $space, 'membership' => $membership]);
    }      


    /**
     * Requests Membership for this Space
     */
    public function actionRequestMembership()
    {
        $this->forcePostRequest();
        $space = Space::findOne(['guid' => Yii::$app->request->get('sguid')]);

        if (!$space->canJoin(Yii::$app->user->id))
            throw new HttpException(500, Yii::t('SpaceModule.controllers_SpaceController', 'You are not allowed to join this space!'));

        if ($space->join_policy == Space::JOIN_POLICY_APPLICATION) {
            // Redirect to Membership Request Form
            return $this->redirect($this->createUrl('//missions/membership/requestMembershipForm', array('sguid' => $space->guid)));
        }

        $space->addMember(Yii::$app->user->id);
        return $this->htmlRedirect($space->getUrl());
    }

    /**
     * Requests Membership Form for this Space
     * (If a message is required.)
     *
     */
    public function actionRequestMembershipForm()
    {
        $space = Space::findOne(['guid' => Yii::$app->request->get('sguid')]);

        // Check if we have already some sort of membership
        if (Yii::$app->user->isGuest || $space->getMembership(Yii::$app->user->id) != null) {
            throw new HttpException(500, Yii::t('SpaceModule.controllers_SpaceController', 'Could not request membership!'));
        }

        $model = new RequestMembershipForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $space->requestMembership(Yii::$app->user->id, $model->message);
            return $this->renderAjax('requestMembershipSave');
        }

        return $this->renderAjax('requestMembership', ['model' => $model, 'space' => $space]);
    }

    /**
     * Revokes Membership for this workspace
     */
    public function actionRevokeMembership()
    {
        //$this->forcePostRequest();
        $space = Space::findOne(['guid' => Yii::$app->request->get('sguid')]);

        if ($space->isSpaceOwner()) {
            throw new HttpException(500, Yii::t('SpaceModule.controllers_SpaceController', 'As owner you cannot revoke your membership!'));
        }

        $space->removeMember();

        return $this->redirect($space->createUrl('/missions/membership/contact'));
    }

    /**
     * When a user clicks on the Accept Invite Link, this action is called.
     * After this the user should be member of this workspace.
     */
    public function actionInviteAccept()
    {

        $this->forcePostRequest();
        $space = Space::findOne(['guid' => Yii::$app->request->get('sguid')]);

        // Load Pending Membership
        $membership = $space->getMembership();
        if ($membership == null) {
            throw new HttpException(404, Yii::t('SpaceModule.controllers_SpaceController', 'There is no pending invite!'));
        }

        // Check there are really an Invite
        if ($membership->status == Membership::STATUS_INVITED) {
            $space->addMember(Yii::$app->user->id);
        }

        return $this->redirect($space->getUrl());
    }


}
