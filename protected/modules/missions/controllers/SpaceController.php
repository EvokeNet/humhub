<?php

namespace humhub\modules\missions\controllers;

use Yii;
use humhub\modules\missions\components\ContentContainerController;


class SpaceController extends ContentContainerController
{

    public function actionMembers()
    {
        $memberQuery = $this->space->getMemberships();
        $memberQuery->joinWith('user');
        $memberQuery->leftJoin('profile', 'user.id = profile.user_id');
        $memberQuery->where(['user.status' => \humhub\modules\user\models\User::STATUS_ENABLED]);
        $memberQuery->orderBy('profile.firstname, profile.lastname');

        return $this->render('members', ['members' => $memberQuery->all()]);
        
    }

}

?>
