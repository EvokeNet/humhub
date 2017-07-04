<?php

use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Evokations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', "{name}'s Evokation", array('name' => $contentContainer->name)), 'url' => ['home', 'sguid' => $contentContainer->guid]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Evokation Voting');

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$canCreateEvokations = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence());

echo \app\modules\missions\widgets\EvokationVotingStream::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/missions/evokations/stream',
    'messageStreamEmpty' => ($canCreateEvokations) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evokations yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evokations yet!'),
    'messageStreamEmptyCss' => ($canCreateEvokations) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ],
    // 'mission_id' => $mission->id,
));

?>
