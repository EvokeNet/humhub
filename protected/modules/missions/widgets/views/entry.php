<?php

use yii\helpers\Html;

echo Html::beginForm(); 
$activity = $evidence->getActivities();
?>

<strong>
   <?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?>
</strong>
<br>
<?php print humhub\widgets\RichText::widget(['text' => $evidence->text]);?>

<br><br>

<div class="clearFloats"></div>

<hr>
<div class="activity_area">
	<?php echo $activity->getMission()->title; ?>
	<br>
	<?php echo $activity->title; ?>
</div>

<?php echo Html::endForm(); ?>

<style type="text/css">

.activity_area{
	font-size: 12px;
}

</style>