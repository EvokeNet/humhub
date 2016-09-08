<?php

use yii\helpers\Html;

echo Html::beginForm();
  $activity = $evidence->getActivities();

?>

<h5><?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?></h5>
<p><?php print humhub\widgets\RichText::widget(['text' => $evidence->text]);?></p>

<div class = "evidence-mission-box">
  <div>
    <p style = "display:inline; float:left; font-weight: 700;"><?= isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title ?></p>
    <p style = "text-align:end; font-weight: 700;"><?= Yii::t('MissionsModule.base', 'Votes: {votes}', array('votes' => $evidence->getVoteCount()? $evidence->getVoteCount() : "0")) ?></p>
  </div>
  <div>
    <p style = "display:inline; float:left; font-weight: 700;"><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?></p>
    <p style = "text-align:end; font-weight: 700;"><?= Yii::t('MissionsModule.base', 'Average Rating: {votes}', array('votes' => $evidence->getAverageRating()? number_format((float)$evidence->getAverageRating(), 1, '.', '') : "-")) ?></p>
  </div>
</div>

<?php echo Html::endForm(); ?>

<BR>

<?php if($evidence->content->user_id != Yii::$app->user->getIdentity()->id && Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h6 class="panel-title">
        <a data-toggle="collapse" href="#collapseEvidence<?= $evidence->id ?>">
        	<?= Yii::t('MissionsModule.base', 'Review') ?>
        </a>
      </h6>
    </div>

    <div id="collapseEvidence<?= $evidence->id ?>" class="panel-collapse collapse">
        <?php
          $collapse = "";
          $yes = "";
          $no = "";
          $grade = 0;
          $vote = $evidence->getUserVote();
          $comment = "";
          if($vote){
            $yes = $vote->flag ? "checked" : "";
            $collapse = $yes ? "in" : "";
            $no = !$vote->flag ? "checked" : "";
            $grade = $vote->value;
            $comment = $vote->comment;
          }
        ?>
        <div>
          <?php
            $primaryPowerTitle = $activity->getPrimaryPowers()[0]->getPower()->title;

            if(Yii::$app->language == 'es' && isset($activity->getPrimaryPowers()[0]->getPower()->powerTranslations[0]))
                $primaryPowerTitle = $activity->getPrimaryPowers()[0]->getPower()->powerTranslations[0]->title;
          ?>
        	<h2><?= Yii::t('MissionsModule.base', 'Distribute points for {title}', array('title' => $primaryPowerTitle)) ?></h2>
        	<p>
        		<?php //$activity->rubric ?>
            <?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric ?>
        	</p>
        	<form id = "review<?= $evidence->id ?>" class="review">
        		<div class="radio">
      				<label>
      					<input type="radio" name="yes-no-opt<?= $evidence->id ?>" class="btn-show<?= $evidence->id ?>" value="yes" <?= $yes ?> >
      					Yes
      				</label>
      				<div id="yes-opt<?= $evidence->id ?>" class="collapse <?= $collapse ?>">
      					<?php for ($x=1; $x <= 5; $x++): ?>
      					<label class="radio-inline">
      						<input type="radio" name="grade<?= $evidence->id ?>" value="<?= $x?>" <?= $x == $grade ? 'checked' : '' ?> >
      						<?php echo $x; ?>
      					</label>
      					<?php endfor; ?>
      					<p>
                  <?= Yii::t('MissionsModule.base', 'How many points will you award this evidence?') ?>
      					</p>
      				</div>
    			  </div>
    			  <div class="radio">
    				  <label>
    					<input type="radio" name="yes-no-opt<?= $evidence->id ?>" class="btn-hide<?= $evidence->id ?>" value="no" <?= $no ?>>
    					 No
    				  </label>
    			  </div>
    			  <br>
            <?php echo Html::textArea("text", $comment , array('id' => 'review_comment_'.$evidence->id, 'class' => 'text-margin form-control ', 'rows' => '5', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.base', "Comment"))); ?>
    			  <br>

    			  <br>
    			  <button type="submit" id="post_submit_review" class="btn btn-cta1">
              <?= Yii::t('MissionsModule.base', 'Submit Review') ?>
    			  </button>
        	</form>
        </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if($evidence->content->user_id == Yii::$app->user->getIdentity()->id || Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>

<BR>

<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h6 class="panel-title">
                <a data-toggle="collapse"  href="#collapseEvidenceReviews<?= $evidence->id ?>" style="color:white">
                    <?= Yii::t('MissionsModule.base', 'Reviews') ?>
                </a>
            </h6>
        </div>

        <div class="panel-body">
            <div id="collapseEvidenceReviews<?= $evidence->id ?>"  class="panel-collapse collapse in">
                <div class="">
                    <?php
                    $votes = $evidence->getVotes();
                    ?>

                    <?php if(!$votes || sizeof($votes) <= 0): ?>
                        <p>
                            <?php echo Yii::t('MissionsModule.base', 'There are no reviews yet.'); ?>
                        </p>
                    <?php endif; ?>

                    <?php foreach($votes as $vote): ?>
                        <div style = "padding: 10px 10px 3px; margin-bottom: 20px; border: 3px solid #9013FE;">
                            <p><?php echo Yii::t('MissionsModule.base', 'Comment: {comment}', array('comment' => $vote->comment)); ?></p>
                            <p><?php echo Yii::t('MissionsModule.base', 'Rating: {rating}', array('rating' => $vote->value)); ?></p>

                            <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors" || $vote->user->group->name == "Mentors"): ?>
                                <p><?php echo Yii::t('MissionsModule.base', 'By'); ?>
                                <a href="<?= ($vote->user->getUrl()) ?>">
                                    <?= ($vote->user->username) ?>
                                </a>,
                                <?php echo \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]); ?></p>
                            <?php else: ?>
                                <p><?php echo Yii::t('MissionsModule.base', 'By Anonymous, {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php endif; ?>


<style type="text/css">

.statistics{
  font-size: 12px;
  text-align: right;
  margin-right: 2%;
}

.activity_area{
	font-size: 12px;
}

</style>

<script>

function review(id, comment, opt, grade){
    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              if(xhttp.responseText == "success"){
                updateReview(id, opt, grade);
              }
            }
        }
    };
    xhttp.open("GET", "<?= $contentContainer->createUrl('/missions/evidence/review'); ?>&opt="+opt+"&grade="+grade+"&evidenceId="+id+"&comment="+comment , true);
    xhttp.send();

    return false;
}

function validateReview<?= $evidence->id ?>(id){

	var opt = document.querySelector('input[name="yes-no-opt'+id+'"]:checked');
	var grade = document.querySelector('input[name="grade'+id+'"]:checked');
  var comment = document.getElementById("review_comment_"+id).value;
	opt = opt? opt.value : null;
	grade = grade? grade.value : null;

/*
***Comment isn't required anymore.***
    if(comment == ""){
        showMessage("Error", "<?= Yii::t('MissionsModule.base', 'You must submit a comment.') ?>");
        return false;
    }
*/

	if(opt == "yes"){

		if(grade >= 1){
			return review(id, comment, opt, grade);
		}

		// showMessage("Error", "Choose how many points you will award this evidence.");
    showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Choose how many points you will award this evidence.') ?>");

	} else if(opt == "no"){
		return review(id, comment, opt);
	} else{
    // showMessage("Error", "Please, Answer yes or no.");
    showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Please, Answer yes or no.') ?>");
  }

	return false;
}

jQuery(document).ready(function () {
        $('#review<?= $evidence->id ?>').submit(
            function(){
                return validateReview<?= $evidence->id ?>(<?= $evidence->id ?>);
            }
        );
    });


$(document).ready(function(){
    $(".btn-hide<?= $evidence->id ?>").click(function(){
        $("#yes-opt<?= $evidence->id ?>").collapse('hide');
    });
    $(".btn-show<?= $evidence->id ?>").click(function(){
        $("#yes-opt<?= $evidence->id ?>").collapse('show');
    });
});
</script>
