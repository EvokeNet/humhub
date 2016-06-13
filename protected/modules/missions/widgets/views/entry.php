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
	<?= isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title ?>
	<br>
	<?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?>
</div>

<?php echo Html::endForm(); ?>

<BR>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapse1">Review</a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse">
    	<h2>Distribute points for Curiosity</h2>
    	<p>
    		Here is  the question that confirms whether or not the evidence is sufficient.
    		Here is  the question that confirms whether or not the evidence is sufficient.
    		Here is  the question that confirms whether or not the evidence is sufficient.
    	</p>
    	<div>
    		<div class="radio">
			<label>
				<input type="radio" name="optradio">
					Yes
				</label>
				<div>
					<label class="radio-inline"><input type="radio" name="optradio">1</label>
					<label class="radio-inline"><input type="radio" name="optradio">2</label>
					<label class="radio-inline"><input type="radio" name="optradio">3</label>
				</div>
			</div>
			<div class="radio">
			<label>
				<input type="radio" name="optradio">
					No
				</label>
			</div>
    	</div>
    </div>
  </div>
</div>


<style type="text/css">

.activity_area{
	font-size: 12px;
}

</style>