<?php
use Yii;
use \yii\helpers\Url;
?>

<?php

echo \humhub\modules\missions\widgets\WallCreateForm::widget([
    'contentContainer' => $contentContainer,
    'submitButtonText' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Submit Evidence'),
    'activity' => $activity,
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Activity {activity}', array('activity' => $activity->title));

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