<?php

use yii\helpers\Html;
$activity = null;

if($evidence){
    $activity = $evidence->getActivities();
}

$user = Yii::$app->user->getIdentity();

if($user->group->name == "Mentors"){
  $title = Yii::t('MissionsModule.base', 'Review Evidences');
} else{
  $title = Yii::t('MissionsModule.base', 'Tag Evidences');
}

$this->pageTitle = $title;

$firstPrimary = true;
$firstSecondary = true;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 style="margin-top:10px"><?php echo $title; ?></h4>
        <?php if($activity): ?>
            <h6><?php echo Yii::t('MissionsModule.base', '{first} of {total}', array('first' => ($evidence_count - $evidence_to_review_count + 1), 'total' => $evidence_count)); ?></h6>
        <?php endif; ?>
    </div>
<?php if($activity): ?>
    <div class="panel-body">

        <!--<div class="formatted" style = "margin-bottom:40px">

            <h5>
                <?php //Yii::t('MissionsModule.base', 'Mission {mission}: Activity {activity}', array('mission' => $activity->mission->position, 'activity' => $activity->position)) ?>
            </h5>

            <p><?php //echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?></p>
        </div>-->

        <!--<div class="review-box evidence_area">-->
        <div class="evidence_area">

            <h5><?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?></h5>

            <?php if(Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
                <p style="font-size:11pt"><?php echo Yii::t('MissionsModule.base', 'By Anonymous in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $evidence->created_at]))); ?></p>
            <?php else: ?>
                <p style="font-size:11pt"><?php echo Yii::t('MissionsModule.base', 'By {user} in {time}', array(
                'user' => Html::a($evidence->content->user->username, ['/user/profile', 'uguid' => $evidence->content->user->guid]),
                'time' => date('F j, Y', strtotime($evidence->created_at)))); ?></p><br />
            <?php endif; ?>

            <br />
            <p><?php print humhub\widgets\RichText::widget(['text' => $evidence->text]); ?></p>
            <br />

            <!-- POWERS -->

            <h6 style="margin-bottom:15px; font-size:12pt"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6>

            <div style="display: flex; flex-wrap: wrap;">
            <?php
                foreach($activity->getPrimaryPowers() as $power):
                    if($firstPrimary)
                        $firstPrimary = false;

                    $name = $power->getPower()->title;

                    if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                        $name = $power->getPower()->powerTranslations[0]->title;
            ?>

                    <div class="power-cards">
                        <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                        <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></p>
                    </div>
                
            <?php endforeach; ?>
            </div> 

            <br />

            <h6 style="margin-bottom:15px; font-size:12pt"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6>
            <div style="display: flex; flex-wrap: wrap;">
                <?php
                    foreach($activity->getSecondaryPowers() as $power):
                        if($firstSecondary)
                            $firstSecondary = false;

                        $name = $power->getPower()->title;

                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                            $name = $power->getPower()->powerTranslations[0]->title;
                ?>
                
                
                    <div class="power-cards">
                        <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                        <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></p>
                    </div>
                
                
                <?php endforeach; ?>
            </div>

            <!-- POWERS -->

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

            <div style="font-size:9pt">
                <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
                    <br>
                    <?= Yii::t('MissionsModule.base', 'Votes: {votes}', array('votes' => $evidence->getVoteCount() ? $evidence->getVoteCount() : "0")) ?>
                    <br>
                    <?= Yii::t('MissionsModule.base', 'Average Rating: {rating}', array('rating' => $evidence->getAverageRating()? number_format((float)$evidence->getAverageRating(), 1, '.', '') : "-")) ?>
                <?php endif; ?>
            </div>

        </div>

        <!-- REVIEWS SECTION -->
        <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>

            <div class="panel-group" style="margin-top:40px">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h6 class="panel-title">
                            <a data-toggle="collapse" href="#collapseEvidenceReviews<?= $evidence->id ?>">
                                <?= Yii::t('MissionsModule.base', 'Reviews'); ?>
                            </a>
                        </h6>
                    </div>

                    <div class="panel-body">
                        <div id="collapseEvidenceReviews<?= $evidence->id ?>" class="panel-collapse collapse in">
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
                                    <div class="submitted-review review-box">
                                         <img class="media-object img-rounded user-image user-<?php echo $vote->user->guid; ?>" alt="40x40"
                                         data-src="holder.js/40x40" style="display: inline-block;"
                                         src="<?php echo $vote->user->getProfileImage()->getUrl(); ?>"
                                         width="40" height="40"/>

                                         &nbsp;<a href="<?= ($vote->user->getUrl()) ?>">
                                            <?= ($vote->user->username) ?>
                                        </a>

                                        <?php echo Yii::t('MissionsModule.base', 'in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>

                                        <p style="margin:20px 0"><?php echo $vote->comment; ?></p>
                                        <p><?php echo Yii::t('MissionsModule.base', 'Rating: {rating}', array('rating' => $vote->value)); ?></p>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        <?php endif; ?>

        <div class = "text-center"><div class = "fuchsia-border"></div></div>

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

                    <!--<h4><?php // Yii::t('MissionsModule.base', 'Distribute points for {title}', array('title' => $primaryPowerTitle)) ?></h4>-->

                    <h5 style="text-transform:uppercase"><?php echo Yii::t('MissionsModule.base', 'Review this Evidence'); ?></h5>

                    <!--<p style = "margin:20px 0"><?php //Yii::t('MissionsModule.base', '<strong>Activity Difficulty Level:</strong> {level}', array('level' => $activity->difficultyLevel->title)) ?></p>-->

                    <p style = "margin:25px 0"><?= Yii::t('MissionsModule.base', 'Choose the keywords that best describe your thoughts on this evidence, both based in your opinion and if it fulfilled the activity rubric. Select the tags and classify with 1 to 5 stars. If you have something to say to your fellow agent, leave a comment.') ?></p>

                    <p style = "margin-bottom:30px"><?= Yii::t('MissionsModule.base', '<strong>Activity Rubric:</strong> {rubric}', array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></p>

                    <form id = "review" class="review">

                    <div class="row">

                        <?php foreach($tags as $tag): ?>
                        <div class="col-xs-4" style="padding-bottom:10px">
                            <input type="checkbox" id="tags" name="tags" value="<?= $tag->id ?>">
                                <?= $tag->getTitleTranslation() ?>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    <!-- only allow allies and mentors to rate/comment -->
                    <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors" || $is_ally): ?>
                    <div style="text-align:center; margin-top:60px">
                        <input type="hidden" id="evidence_id" value="<?= $evidence->id ?>">
                        <span class="rating">
                            <?php for ($x=5; $x >= 1; $x--): ?>
                            <input id="grade<?= $x ?>" onClick="setStarHint(<?= $x ?>);$('#yes-input<?= $evidence->id ?>').prop('checked', true)" type="radio" name="grade" class="rating-input" value="<?= $x?>" <?= $x == $grade ? 'checked' : '' ?> />
                            <label for ="grade<?= $x ?>" class="rating-star"></label>
                            <?php endfor; ?>
                        </span>
                        <label class="star_label" id="star_hint" style="display:block; padding-bottom: 20px; padding-top: 10px;"></label>
                    </div>

                    </br>
                    </br>


                        <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
                            <p style="float:right"><?php echo Yii::t('MissionsModule.base', '{user} awarded + {value} {title}', array('user' => '', 'title' => $primaryPowerTitle, 'value' => $activity->getPrimaryPowers()[0]->value)); ?></p>
                        <?php endif; ?>

                        <?php echo Html::textArea("text", $comment , array('id' => 'review_comment', 'class' => 'text-margin form-control count-chars ', 'rows' => '5', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.base', "Leave a comment (optional)"))); ?>
                        <br>

                        <button type="submit" id="post_submit_review" class="btn btn-cta2">
                            <?= Yii::t('MissionsModule.base', 'Submit Review') ?>
                        </button>
                    <?php endif; ?>
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
</div>

<script>


function review(id, comment, opt, grade, tags){
    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            next_element = document.getElementById("next_evidence");
            next_element.removeAttribute("disabled");
            next_element.removeAttribute("onClick");
            document.getElementById("post_submit_review").innerHTML = "<?php echo Yii::t('MissionsModule.base', 'Update Review'); ?>";
            loadPopUps();
            updateEvocoins();
        }
    };
    xhttp.open(
        "GET",
        "<?= $contentContainer->createUrl('/missions/evidence/review'); ?>&opt="+opt+
        "&grade="+grade+
        "&evidenceId="+id+
        "&comment="+comment+
        getTagsArrayUrl(tags),
        true
    );
    xhttp.send();

    return false;
}

function getTagsArrayUrl(tags){
    var url = "";
    for(var x = 0; x < tags.length; x++){
        url = url + "&tags[]=" + tags[x];
    }
    return url;
}

function validateReview(id){

    var opt = 'yes'; //always yes for agents
    var grade = document.querySelector('input[name="grade"]:checked');
    var comment = document.getElementById("review_comment").value;
    var tag_inputs = $("input[name=tags]:checked");
    var tags = [];
    for(var x = 0; x < tag_inputs.length; x++){
        tags.push(tag_inputs[x].value);
    }
    grade = grade? grade.value : null;

    if(!grade){
        showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Choose how many points you will award this evidence.') ?>");
        return false;
    }

  return review(id, comment, opt, grade, tags);
}

jQuery(document).ready(function () {
  var $submitButton = $('#post_submit_review');
  console.log($submitButton);
  $submitButton.on('click', function(e){
    console.log('click');
    $('#review').submit(
        function(){
            return validateReview(document.getElementById("evidence_id").value);
        }
    );

  });
});

function setStarHint(value){
  switch(value){
    case 1:
      $('#star_hint').html("<?= Yii::t('MissionsModule.base', 'Does not comply with the rubric') ?>");
    break;
    case 2:
      $('#star_hint').html("<?= Yii::t('MissionsModule.base', 'Meets the required minimum') ?>");
    break;
    case 3:
      $('#star_hint').html("<?= Yii::t('MissionsModule.base', 'Good') ?>");
    break;
    case 4:
      $('#star_hint').html("<?= Yii::t('MissionsModule.base', 'Excellent') ?>");
    break;
    case 5:
      $('#star_hint').html("<?= Yii::t('MissionsModule.base', 'Outstanding') ?>");
    break;
  }
}

</script>
