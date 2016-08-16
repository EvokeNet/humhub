<?php

use yii\helpers\Html;
$activity = null;

if($evidence){
    $activity = $evidence->getActivities();  
}

$this->pageTitle = Yii::t('MissionsModule.event', 'Review Evidence');

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo Yii::t('MissionsModule.base', 'Review Evidence'); ?></h3>
        <?php if($activity): ?>
        <h6><?php echo Yii::t('MissionsModule.base', '{first} of {total}', array('first' => ($evidence_count - $evidence_to_review_count + 1), 'total' => $evidence_count)); ?></h6>
        <?php endif; ?>
    </div>
<?php if($activity): ?>
    <div class="panel-body">

        <div class="formatted" style = "margin-bottom:40px">
            <h4>
                <?= Yii::t('MissionsModule.base', 'Mission {mission}: Activity {activity}', array('mission' => $activity->mission->position, 'activity' => $activity->position)) ?>
            </h4>

            <p><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description ?></p>
        </div>

        <div class="grey-box evidence_area">
            <h3><?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?></h3>
            <br>
            <p><?php print humhub\widgets\RichText::widget(['text' => $evidence->text]); ?></p>
        

            <?php if(sizeof($files) > 0): ?>
            <div class="files_area">
                <?php foreach ($files as $file): ?>
                    <a data-toggle="lightbox" data-gallery="<?php
                    if (count($files) > 1) {
                        echo "gallery-" . $evidence->content->getUniqueId();
                    }
                    ?>" href="<?php echo $file->getUrl(); ?>#.jpeg"  data-footer='<button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo Yii::t('FileModule.widgets_views_showFiles', 'Close'); ?></button>'>
                        <img src='<?php echo $file->getPreviewImageUrl(200, 200); ?>'>
                    </a>
                <?php endforeach;?>
            </div>
            <?php endif;?>

            <div class="statistics">
                <?php if(Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
                    <?php //echo \humhub\widgets\TimeAgo::widget(['timestamp' => $evidence->created_at]); ?>
                    <p><?php echo Yii::t('MissionsModule.base', 'By Anonymous, {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $evidence->created_at]))); ?></p>
                <?php else: ?>
                    <p><?php echo Yii::t('MissionsModule.base', 'By'); ?></p> 
                    <a href="<?= ($evidence->content->user->getUrl()) ?>">
                        <?= ($evidence->content->user->username) ?>
                    </a>, 
                    <?php echo \humhub\widgets\TimeAgo::widget(['timestamp' => $evidence->created_at]); ?>
                    <br>
                    <?= Yii::t('MissionsModule.base', 'Votes: {votes}', array('votes' => $evidence->getVoteCount() ? $evidence->getVoteCount() : "0")) ?>
                    <br>
                    <?= Yii::t('MissionsModule.base', 'Average Rating: {rating}', array('rating' => $evidence->getAverageRating()? number_format((float)$evidence->getAverageRating(), 1, '.', '') : "-")) ?> 
                <?php endif; ?>
            </div>
        
        </div>

        <!-- REVIEWS SECTION -->
        <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>

            <div class = "text-center"><div class = "blue-border"></div></div>  

            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">
                            <a data-toggle="collapse" href="#collapseEvidenceReviews<?= $evidence->id ?>">
                                <?= Yii::t('MissionsModule.base', 'Reviews') ?>
                            </a>
                        </h6>
                    </div>
                    
                    <div class="panel-body">
                        <div id="collapseEvidenceReviews<?= $evidence->id ?>" class="panel-collapse collapse">
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
                                        
                                        <p><?php echo Yii::t('MissionsModule.base', 'By'); ?>
                                        <a href="<?= ($vote->user->getUrl()) ?>">
                                            <?= ($vote->user->username) ?>
                                        </a>, 
                                        <?php echo \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>   

        <?php endif; ?>       

        <div class = "text-center"><div class = "blue-border"></div></div>

        <div class="review evidence_area">
        <?php if($evidence->content->user_id != Yii::$app->user->getIdentity()->id): ?>  
            <div>
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
                    $power = $activity->getPrimaryPowers()[0]->getPower();
                    $primaryPowerTitle = isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title; ?>
                    <h4><?= Yii::t('MissionsModule.base', 'Distribute points for {title}', array('title' => $primaryPowerTitle)) ?></h4>
                    <p style = "margin-bottom:25px"><?= Yii::t('MissionsModule.base', '<strong>Activity Rubric:</strong> {rubric}', array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></p>
                    
                	<form id = "review" class="review">
                        <input type="hidden" id="evidence_id" value="<?= $evidence->id ?>">
                		<div class="radio" style = "margin-bottom:15px">
              				<label>
              					<input type="radio" name="yes-no-opt" class="btn-show" value="yes" <?= $yes ?> >
              					<?= Yii::t('MissionsModule.base', 'Yes') ?>
              				</label>
                            
                            <br>
              				<div id="yes-opt" class="collapse <?= $collapse ?>">
                                <br><p><?= Yii::t('MissionsModule.base', 'How many points will you award this evidence?') ?></p>
              					<?php for ($x=1; $x <= 5; $x++): ?> 
              					<label class="radio-inline">
              						<input type="radio" name="grade" value="<?= $x?>" <?= $x == $grade ? 'checked' : '' ?> >
              						<?php echo $x; ?>
              					</label>
              					<?php endfor; ?>
                                  <br><br><br>
              				</div>
                            
            			  </div>
            			  <div class="radio" style = "margin-bottom:15px">
            				  <label>
            					<input type="radio" name="yes-no-opt" class="btn-hide" value="no" <?= $no ?>>
            					 <?= Yii::t('MissionsModule.base', 'No') ?>
            				  </label>
            			  </div>
            			  <br>
                            
                          <?php echo Html::textArea("text", $comment , array('id' => 'review_comment', 'class' => 'text-margin form-control ', 'rows' => '5', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.base', "Comment"))); ?>  
                          <br>
                          
                          <!--
                          <label class = "label label-secondary2"><?php // Yii::t('MissionsModule.base', 'For every piece of evidence you review, you receive 10 points in {title}', array('title' => $primaryPowerTitle)) ?></label><br>
            			  -->
            			  <button type="submit" id="post_submit_review" class="btn btn-cta2" style = "padding: 8px 16px 6px;">
                            <?= Yii::t('MissionsModule.base', 'Submit Review') ?>
            			  </button>
                	</form>
                </div>
            </div>
        <?php endif; ?> 
            <hr>
            <a id="next_evidence" class="btn btn-cta3" disabled="disabled" style="float: right;" onClick="return false" href="<?= $contentContainer->createUrl('/missions/review/index') ?>">
                <?php echo Yii::t('MissionsModule.base', 'Next Evidence'); ?>
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="panel-body">
        <?php echo Yii::t('MissionsModule.base', 'There are no more evidences left to review.'); ?>
    </div>
<?php endif; ?>

</div>


<style type="text/css">

.statistics{
    font-size: 12px;
    text-align: right;
    margin-right: 2%;
    padding-top: 10px;
}

.activity_area{
    background: #e2e2e2;
	font-size: 12px;
    padding: 15px;
    font-weight: bold;
    border-radius: 4px
}

.files_area{
    padding: 15px;
    background: #e2e2e2;
    border-radius: 4px;
    text-align: center;
}

</style>

<script>


function review(id, comment, opt, grade){
    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            next_element = document.getElementById("next_evidence");
            next_element.removeAttribute("disabled");
            next_element.removeAttribute("onClick");
            document.getElementById("post_submit_review").innerHTML = "<?php echo Yii::t('MissionsModule.base', 'Update Review'); ?>";
        }
    };
    xhttp.open("GET", "<?= $contentContainer->createUrl('/missions/evidence/review'); ?>&opt="+opt+"&grade="+grade+"&evidenceId="+id+"&comment="+comment , true);
    xhttp.send();

    return false;
}

function validateReview(id){

	var opt = document.querySelector('input[name="yes-no-opt"]:checked');
	var grade = document.querySelector('input[name="grade"]:checked');
    var comment = document.getElementById("review_comment").value;
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

    showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Choose how many points you will award this evidence.') ?>");
		
	} else if(opt == "no"){
		return review(id, comment, opt);
	} else{

    showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Please, Answer yes or no.') ?>");
  }

	return false;
}

jQuery(document).ready(function () {
        $('#review').submit(
            function(){
                return validateReview(document.getElementById("evidence_id").value);
            }
        );
    });


$(document).ready(function(){
    $(".btn-hide").click(function(){
        $("#yes-opt").collapse('hide');
    });
    $(".btn-show").click(function(){
        $("#yes-opt").collapse('show');
    });
});
</script>