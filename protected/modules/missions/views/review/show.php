<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use humhub\compat\CActiveForm;

$user = Yii::$app->user->getIdentity();

if($user->group->name == "Mentors"){
  $title = Yii::t('MissionsModule.base', 'Review Evidences');
} else{
  $title = Yii::t('MissionsModule.base', 'Tag Evidences');
}

$this->pageTitle = $title;

$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['list', 'sguid' => $contentContainer->guid]];
$this->params['breadcrumbs'][] = $this->title;
        
echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$activity = null;

if($evidence){
    $activity = $evidence->getActivities();
}

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 style="margin-top:10px"><?php echo $title; ?></h4>
        <?php if($activity): ?>
            <!-- <h6><?php //echo Yii::t('MissionsModule.base', '{first} of {total}', array('first' => ($evidence_count - $evidence_to_review_count + 1), 'total' => $evidence_count)); ?></h6> -->
        <?php endif; ?>
    </div>
<?php if($activity): ?>
    <div class="panel-body">

        <div class="formatted" style = "margin-bottom:40px">

            <h5>
                <?= Yii::t('MissionsModule.base', 'Mission #{mission} - Activity #{activity}', array('mission' => $activity->mission->position, 'activity' => $activity->position)) ?>
            </h5><br />

            <p><?php echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?></p>
        </div>

        <div class="grey-box evidence_area">
            <h4><?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?></h4>
            <br />
            <p><?php print humhub\widgets\RichText::widget(['text' => $evidence->text]); ?></p>
            <br />


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
                                    <div class="submitted-review review-box" style="position:relative">

                                        <img class="media-object img-rounded user-image user-<?php echo $vote->user->guid; ?>" alt="40x40"
                                         data-src="holder.js/40x40" style="display: inline-block;"
                                         src="<?php echo $vote->user->getProfileImage()->getUrl(); ?>"
                                         width="40" height="40"/>

                                        &nbsp;<a href="<?= ($vote->user->getUrl()) ?>">
                                            <?= ($vote->user->username) ?>
                                        </a>

                                        <?php echo Yii::t('MissionsModule.base', 'in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>

                                        <p style="padding:5px 10px 5px 45px"><?php echo $vote->comment; ?></p>

                                        <?php if($vote->value == 0): ?>
                                            <div class="alert alert-danger" style="margin:10px 0">
                                              <?php echo Yii::t('MissionsModule.base', 'Does not meet rubric'); ?>
                                            </div>
                                        <?php else: ?>

                                            <div class="stars" style="margin:10px 0">
                                                <?php for ($i = 0; $i < 5; $i++): ?>
                                                    <?php if ($vote->value > $i): ?>
                                                    <?php if (($vote->value - $i) < 1): ?>
                                                      <i class="fa fa-star-half-o fa-lg" aria-hidden="true"></i>
                                                    <?php else: ?>
                                                      <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>

                                        <?php endif; ?>

                                        <!-- <p><?php //echo Yii::t('MissionsModule.base', 'Rating: {rating}', array('rating' => $vote->value)); ?></p> -->

                                        <div style="margin:20px 0 10px">
                                            <?php if(Yii::$app->user->isAdmin()): ?>

                                                <?php

                                                $enable = "";
                                                $disable = "hidden";
                                                $disables = "hidden";

                                                if ($vote->quality == 1) {
                                                    $enable = "hidden";
                                                    $disable = "";
                                                    $disables = "";

                                                } 

                                                echo \humhub\widgets\AjaxButton::widget([
                                                    'label' => Yii::t('MissionsModule.base', 'Mark as quality review'),
                                                    'ajaxOptions' => [
                                                        'type' => 'POST',
                                                        'success' => new yii\web\JsExpression('function(){
                                                    $("#btn-enable-module-' . $vote->id . '").addClass("hidden");
                                                    $("#btn-disable-module-' . $vote->id . '").removeClass("hidden");

                                                    $("#btn-disables-module-' . $vote->id . '").removeClass("hidden");

                                                    }'),
                                                        'url' => Url::to(['admin/update-quality-reviews', 'id' => $vote->id, 'mark' => 1, 'user_id' => $vote->user_id]),
                                                    ],
                                                    'htmlOptions' => [
                                                        'class' => 'btn btn-sm btn-primary '. $enable,
                                                        'id' => 'btn-enable-module-' . $vote->id
                                                    ]
                                                ]);
                                                ?>


                                                <?php

                                                echo \humhub\widgets\AjaxButton::widget([
                                                    'label' => Yii::t('MissionsModule.base', 'Unmark as quality review'),
                                                    'ajaxOptions' => [
                                                        'type' => 'POST',
                                                        'success' => new yii\web\JsExpression('function(){
                                                    $("#btn-enable-module-' . $vote->id . '").removeClass("hidden");
                                                    $("#btn-disable-module-' . $vote->id . '").addClass("hidden");

                                                    $("#btn-disables-module-' . $vote->id . '").addClass("hidden");

                                                     }'),
                                                        'url' => Url::to(['admin/update-quality-reviews', 'id' => $vote->id, 'mark' => 0, 'user_id' => $vote->user_id]),
                                                    ],
                                                    'htmlOptions' => [
                                                        'class' => 'btn btn-sm btn-info '. $disable,
                                                        'id' => 'btn-disable-module-' . $vote->id
                                                    ]
                                                ]);
                                                ?>

                                                <div class="trophy-icon <?= $disables ?>" id="btn-disables-module-<?php echo $vote->id; ?>" style="position: absolute; top: 0; right: 10px;"><i class="fa fa-trophy fa-lg" aria-hidden="true"></i></div>

                                                <?php 
                                                    // if($vote->quality == 0){
                                                    //     echo Html::a(Yii::t('MissionsModule.base', 'Mark as quality review'), ['admin/update-quality-reviews-on-site', 'id' => $vote->id, 'mark' => 1, 'user_id' => $vote->user_id], ['class' => 'btn btn-primary btn-sm']);
                                                    // }
                                                    // else{
                                                    //     echo Html::a(Yii::t('MissionsModule.base', 'Unmark as quality review'), ['admin/update-quality-reviews-on-site', 'id' => $vote->id, 'mark' => 0, 'user_id' => $vote->user_id], ['class' => 'btn btn-primary btn-sm']); 
                                                    // }
                                                ?>
                                            <?php endif; ?>
                                        </div>

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
                    <p style = "margin:20px 0"><?= Yii::t('MissionsModule.base', '<strong>Activity Difficulty Level:</strong> {level}', array('level' => $activity->difficultyLevel->title)) ?></p>
                    <p style = "margin-bottom:25px"><?= Yii::t('MissionsModule.base', '<strong>Activity Rubric:</strong> {rubric}', array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></p>

                <form id = "review" class="review">

                    <input type="hidden" id="evidence_id" value="<?= $evidence->id ?>">
                    <?php for ($x=1; $x <= 5; $x++): ?>
                    <label class="radio-inline">
                      <input type="radio" name="grade" value="<?= $x?>" <?= $x == $grade ? 'checked' : '' ?> >
                      <?php echo $x; ?>
                    </label>
                    <?php endfor; ?>

                    </br>
                    </br>


                        <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
                            <p style="float:right"><?php echo Yii::t('MissionsModule.base', '{user} awarded + {value} {title}', array('user' => '', 'title' => $primaryPowerTitle, 'value' => $activity->getPrimaryPowers()[0]->value)); ?></p>
                        <?php endif; ?>

                        <?php echo Html::textArea("text", $comment , array('id' => 'review_comment', 'class' => 'text-margin form-control count-chars ', 'rows' => '5', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.base', "140 characters required"))); ?>
                        <br>
                        
                        <button type="submit" id="post_submit_review" class="btn btn-cta2" style = "padding: 8px 16px 6px;">
                        <?= Yii::t('MissionsModule.base', 'Submit Review') ?>
                        </button>
                            
                </div>
        <?php endif; ?>
            <hr>
            <!-- <a id="next_evidence" class="btn btn-cta3" disabled="disabled" style="float: right;" onClick="return false" href="<?= $contentContainer->createUrl('/missions/review/index') ?>">
                <?php //echo Yii::t('MissionsModule.base', 'Next Evidence'); ?>
            </a> -->
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
    var opt = 'yes'; //always yes for agents
    var grade = document.querySelector('input[name="grade"]:checked');
  var comment = document.getElementById("review_comment").value;
    grade = grade? grade.value : null;
  console.log(grade);
  
  return review(id, comment, opt, grade);
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
</script>