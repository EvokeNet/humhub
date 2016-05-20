<?php

use yii\helpers\Html;

echo Yii::t('MissionsModule.views_activities_Post', '{userDisplayName} posted {contentTitle}', array(
    '{userDisplayName}' => '<strong>' . Html::encode($originator->displayName) . '</strong>',
    '{contentTitle}' => $preview,
));
?>
