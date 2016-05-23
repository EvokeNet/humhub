<?php

use yii\helpers\Html;

echo Yii::t('MissionsModule.views_activities_newEvidence', '{userDisplayName} posted {contentTitle}', array(
    '{userDisplayName}' => '<strong>' . Html::encode($originator->displayName) . '</strong>',
    '{contentTitle}' => $source->getContentName(),
));
?>
