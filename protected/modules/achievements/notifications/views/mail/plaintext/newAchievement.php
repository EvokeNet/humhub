<?php

use yii\helpers\Html;

?>
<?php
echo Yii::t('AchievementsModule.views_notifications_newAchievement', "You've gained a new achievement:<br> %message%.", array(
    '%message%' => $source->title
));
?>