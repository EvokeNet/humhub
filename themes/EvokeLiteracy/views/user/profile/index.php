<?php 

use app\modules\powers\models\UserPowers;

$this->pageTitle = $user->username;

$userPowers = UserPowers::getUserPowers($user->id);

if($user->id == Yii::$app->user->id){
	echo \humhub\modules\missions\widgets\MyReviews::widget(['powers' => $userPowers]);
    echo \humhub\modules\achievements\widgets\MyQualityReviews::widget(['powers' => $userPowers]);
}

if($user->group->name != "Mentors"){
	echo \humhub\modules\missions\widgets\SuperPowerStats::widget(['powers' => $userPowers]);
}

echo \humhub\modules\post\widgets\Form::widget(['contentContainer' => $user]); 

$canCreateEvidences = $user->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence());

echo humhub\modules\content\widgets\Stream::widget(array(
    'contentContainer' => $user,
    'streamAction' => '/missions/evidence/userfeed',
    'messageStreamEmpty' => ($canCreateEvidences) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'Nothing here yet!'),
    'messageStreamEmptyCss' => ($canCreateEvidences) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ]
));
