<?php

use \yii\helpers\Url;
use app\modules\missions\models\Evidence;
use yii\widgets\Breadcrumbs;

$hasUserSubmittedEvidence = Evidence::hasUserSubmittedEvidence($activity->id);

$mission_title = isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title;

$activity_title = isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title;

$this->title = $mission_title; //Yii::t('MissionsModule.base', 'Activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['missions', 'sguid' => $contentContainer->guid]];
// $this->params['breadcrumbs'][] = $mission->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Mission {position} - {alias}', array('position' => $activity->mission->position, 'alias' => $this->title)), 'url' => ['activities', 'missionId' => $activity->mission->id, 'sguid' => $contentContainer->guid]]; //Yii::t('MissionsModule.base', 'Mission:').' '.$this->title;
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Activity {position} - {alias}', array('position' => $activity->position, 'alias' => $activity_title));

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Activity {position} - {alias}', array('position' => $activity->position, 'alias' => $activity_title));

?>

<?php

if(!$hasUserSubmittedEvidence){

    echo \humhub\modules\missions\widgets\WallCreateForm::widget([
        'contentContainer' => $contentContainer,
        'submitButtonText' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Submit Evidence'),
        'activity' => $activity,
        
    ]);

}

$this->pageTitle = Yii::t('MissionsModule.base', 'Activity {activity}', array('activity' => $activity_title));

?>

<?php

$canCreateEvidences = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence());

echo \app\modules\missions\widgets\EvidenceStream::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/missions/evidence/stream',
    'messageStreamEmpty' => ($canCreateEvidences) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet!'),
    'messageStreamEmptyCss' => ($canCreateEvidences) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ],
    'activity_id' => $activity->id,
));

?>
