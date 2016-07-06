<?php 

use app\modules\powers\models\UserPowers;

$userPowers = UserPowers::getUserPowers($user->id);

echo \humhub\modules\missions\widgets\SuperPowerStats::widget(['powers' => $userPowers]);

echo \humhub\modules\post\widgets\Form::widget(['contentContainer' => $user]); 

$module_user_permission = \humhub\modules\user\models\Module::getStates();

echo "<pre>";
print_r($module_user_permission);
echo "</pre>";

echo \app\modules\missions\widgets\EvidenceStream::widget(array(
    'contentContainer' => $user,
    'streamAction' => '/missions/evidence/userfeed',
    'messageStreamEmpty' => ($user->canWrite()) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet!'),
    'messageStreamEmptyCss' => ($user->canWrite()) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ]
));
