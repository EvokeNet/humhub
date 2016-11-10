<?php

use yii\helpers\Html;

$source_title = (isset($source->achievementTranslations[0]) && Yii::$app->language == 'es') ? $source->achievementTranslations[0]->title : $source->title;

?>

<?php
	echo Yii::t('AchievementsModule.views_notifications_newAchievement', 'Your review for {message} has been marked as a quality review.', array(
	    'message' => $source_title
	));
?>