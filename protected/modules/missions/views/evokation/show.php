<?php
use Yii;
use \yii\helpers\Url;
?>

<?php



$this->pageTitle = Yii::t('MissionsModule.page_titles', 'Mission {mission}', array('mission' => $mission ->title));

?>

<?php

$canCreateEvokations = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence());

echo humhub\modules\content\widgets\Stream::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/missions/evokation/stream',
    'messageStreamEmpty' => ($canCreateEvokations) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evokations yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evokations yet!'),
    'messageStreamEmptyCss' => ($canCreateEvokations) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ]
));

?>