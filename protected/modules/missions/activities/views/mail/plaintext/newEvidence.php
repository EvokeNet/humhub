<?php

use yii\helpers\Html;

echo strip_tags(Yii::t('MissionsModule.views_activities_newEvidence', '{userDisplayName} posted {contentTitle}', array(
    '{userDisplayName}' => Html::encode($originator->displayName),
    '{contentTitle}' => $preview,
)));
?>
