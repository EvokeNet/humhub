<?php

use yii\helpers\Html;

?>
<?php
echo Yii::t('AchievementsModule.views_notifications_newAchievement', "Your review for '%message%' has been marked as a quality review.", array(
    '%message%' => $source->title
));
?>