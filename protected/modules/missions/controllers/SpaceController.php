<?php

namespace humhub\modules\missions\controllers;

use Yii;
use humhub\modules\missions\components\ContentContainerController;


class SpaceController extends ContentContainerController
{


	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => \humhub\components\behaviors\AccessControl::className(),
                'guestAllowedActions' => ['index', 'stream']
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return array(
            'stream' => array(
                'class' => \humhub\modules\missions\components\actions\ContentContainerStream::className(),
                'contentContainer' => $this->contentContainer
            ),
        );
    }

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
