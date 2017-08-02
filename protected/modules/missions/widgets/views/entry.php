<?php

use yii\helpers\Html;
use humhub\libs\Helpers;
use humhub\models\Setting;
use yii\helpers\Url;
use yii\web\JsExpression;
use humhub\compat\CActiveForm;
use app\modules\missions\models\Votes;

$this->registerJsFile('js/stream.js');

echo Html::beginForm();
  $activity = $evidence->getActivities();
  $mentor_average_votes = $evidence->getAverageRating('Mentors');
  $user_average_votes = $evidence->getAverageRating('Users');
  $mentor_vote_count = $evidence->getVoteCount('Mentors');
  $agent_vote_count = $evidence->getVoteCount('Users');
  $agent_vote_count = $agent_vote_count ? $agent_vote_count : 0;

?>

<style media="screen">
  .tags_panel {
    display: none;
  }
</style>

<!-- EVIDENCE -->
<?php if($evidence->content->visibility >= 1): ?>

<<<<<<< HEAD
    <h5 style="margin-top:30px; color: #FEAE1B"><?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?></h5>
=======
    <div class="user-content-box">
        <h4><?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?></h4>
>>>>>>> f5466e1a9a7dcb492a6d8e680f8e5fab835fe9ed

        <?php if (Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
        <!-- <h6><?php //echo Yii::t('MissionsModule.base', 'By'); ?> <?php echo $name ?></h6> -->
        <?php endif; ?>

<<<<<<< HEAD
    <p style="margin:25px 0 50px"><?php print humhub\widgets\RichText::widget(['text' => $evidence->text]);?></p>

    <!-- SHOW FILES -->

    <?php $files = \humhub\modules\file\models\File::getFilesOfObject($evidence); ?>

    <?php if(!empty($files)): ?>
    <ul class="files" style="list-style: none; margin: 0" id="files-<?php echo $evidence->getPrimaryKey(); ?>">
        <?php foreach ($files as $file) : ?>
            <?php
            if ($file->getMimeBaseType() == "image" && Setting::Get('hideImageFileInfo', 'file'))
                continue;
            ?>
            <li class="mime <?php echo \humhub\libs\MimeHelper::getMimeIconClassByExtension($file->getExtension()); ?>" style="padding: 0">

              <a href="<?php echo $file->getUrl(); ?>" target="_blank" style="font-size:9pt; padding: 1px 0 4px 26px;">
                <span class="filename"><?php echo Html::encode(Helpers::trimText($file->file_name, 40)); ?></span>
              </a>

                <!-- <span class="time" style="padding-right: 20px;"> - <?php echo Yii::$app->formatter->asSize($file->size); ?></span> -->

                <?php if ($file->getExtension() == "mp3") : ?>
                    <!-- Integrate jPlayer -->
                    <?php
                    echo xj\jplayer\AudioWidget::widget(array(
                        'id' => $file->id,
                        'mediaOptions' => [
                            'mp3' => $file->getUrl(),
                        ],
                        'jsOptions' => [
                            'smoothPlayBar' => true,
                        ]
                    ));
                    ?> 
                <?php elseif ($file->canRead() && ($file->getExtension() == "png" || $file->getExtension() == "jpg" || $file->getExtension() == "jpeg")) : ?>

                  <br>

                  <a href="<?php echo $file->getPreviewImageUrl(); ?>">
                    <img src="<?php echo $file->getPreviewImageUrl(); ?>" width="100" style="margin-top:15px"/>
                  </a>

                <?php endif; ?>

            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
=======
        <p style="margin:20px 0 50px;"><?php print humhub\widgets\RichText::widget(['text' => $evidence->text]);?></p>
>>>>>>> f5466e1a9a7dcb492a6d8e680f8e5fab835fe9ed

        <!-- SHOW FILES -->

        <?php $files = \humhub\modules\file\models\File::getFilesOfObject($evidence); ?>

        <?php if(!empty($files)): ?>
        <ul class="files" style="list-style: none; margin: 0;" id="files-<?php echo $evidence->getPrimaryKey(); ?>">
            <?php foreach ($files as $file) : ?>
                <?php
                if ($file->getMimeBaseType() == "image" && Setting::Get('hideImageFileInfo', 'file'))
                    continue;
                ?>
                <li class="mime <?php echo \humhub\libs\MimeHelper::getMimeIconClassByExtension($file->getExtension()); ?>"><a
                        href="<?php echo $file->getUrl(); ?>" target="_blank"><span
                            class="filename"><?php echo Html::encode(Helpers::trimText($file->file_name, 40)); ?></span></a>
                    <span class="time" style="padding-right: 20px;"> - <?php echo Yii::$app->formatter->asSize($file->size); ?></span>

<<<<<<< HEAD
        <div class="mentor-votes col-xs-6" style="border-left: 2px solid #FF4351;">

          <div class="stars">
            <?php for ($i = 0; $i < 5; $i++): ?>
              <?php if ($user_average_votes > $i): ?>
                <?php if (($user_average_votes - $i) < 1): ?>
                  <i class="fa fa-star-half-o" aria-hidden="true"></i>
                <?php else: ?>
                  <i class="fa fa-star" aria-hidden="true"></i>
                <?php endif; ?>
              <?php else: ?>
                <i class="fa fa-star-o" aria-hidden="true"></i>
              <?php endif; ?>
            <?php endfor; ?>
            <p>
              <?php echo Yii::t('MissionsModule.base', 'Avg Agents Rating'); ?>
            </p>
          </div>

          <!-- <div class="rating no-padding-left">
            <span style="font-size: 9pt; font-weight:700">
              <?php echo Yii::t('MissionsModule.base', 'Average Rating: {votes}', array('votes' => $mentor_average_votes? number_format((float)$mentor_average_votes, 1, '.', '') : "-")); ?>
            </span>
            <span style="font-size: 9pt; font-weight:700">
              <?php echo Yii::t('MissionsModule.base', 'Mentor Reviews: {votes}', array('votes' => $evidence->getVoteCount('Mentors')? $evidence->getVoteCount('Mentors') : "0")) ?>
            </span>
          </div> -->

          <!-- <div class="rating">
            <span style="font-size: 9pt; font-weight:700">
              <?php echo Yii::t('MissionsModule.base', 'Average Rating: {votes}', array('votes' => $user_average_votes? number_format((float)$user_average_votes, 1, '.', '') : "-")); ?>
            </span>
            <span style="font-size: 9pt; font-weight:700">
              <?php echo Yii::t('MissionsModule.base', 'Agent Reviews: {votes}', array('votes' => $agent_vote_count)) ?>
            </span>
          </div> -->

        </div>
=======
                    <?php if ($file->getExtension() == "mp3") : ?>
                        <!-- Integrate jPlayer -->
                        <?php
                        echo xj\jplayer\AudioWidget::widget(array(
                            'id' => $file->id,
                            'mediaOptions' => [
                                'mp3' => $file->getUrl(),
                            ],
                            'jsOptions' => [
                                'smoothPlayBar' => true,
                            ]
                        ));
                        ?>
                    <?php elseif ($file->canRead() && ($file->getExtension() == "png" || $file->getExtension() == "jpg" || $file->getExtension() == "jpeg")) : ?>
>>>>>>> f5466e1a9a7dcb492a6d8e680f8e5fab835fe9ed

                    <br /><br />

                    <a href="<?php echo $file->getPreviewImageUrl(); ?>"><img src="<?php echo $file->getPreviewImageUrl(); ?>" width="150"/></a>

                    <?php endif; ?>

                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>

    </div>

    <?php echo Html::endForm(); ?>

    </br>

    <!-- show activity text -->
    <div class="activity-text">
      <h4><?php echo $activity->id_code; ?> - <?php echo isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title; ?></h4>
      <div class="activity-body">
        <?php echo isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description; ?>
      </div>
    </div>

    </br>

    <?php
      if($evidence->content->user_id != Yii::$app->user->getIdentity()->id){
        //already voted
        if($vote = $evidence->getUserVote()){
          echo $this->render('user_vote_view', array('vote' => $vote, 'contentContainer' => $contentContainer));
        } elseif( Yii::$app->user->getIdentity()->group->name == "Mentors" || $is_ally){ //allies and mentors can review
          echo $this->render('mentor_review', array('evidence' => $evidence, 'activity' => $activity));
        }
      }
    ?>

    <BR>

    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a  style="cursor: default" aria-expanded="false" class="collapsed">
                        <?= Yii::t('MissionsModule.base', 'Mentor Reviews') ?>
                    </a>
                </h6>
            </div>

            <!-- if there's at  least one review -->
            <?php if($mentor_vote_count > 0): ?>
              <div class="tags_panel">

              <div class="mentors_avg_stars stars" title="<?= number_format((float)$mentor_average_votes, 2, '.', '') ?>">
                <?php for ($i = 0; $i < 5; $i++): ?>
                  <?php if ($mentor_average_votes > $i): ?>
                    <?php if (($mentor_average_votes - $i) < 1): ?>
                      <i class="fa fa-star-half-o fa-lg" aria-hidden="true"></i>
                    <?php else: ?>
                      <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                    <?php endif; ?>
                  <?php else: ?>
                    <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                  <?php endif; ?>
                <?php endfor; ?>
              </div>

              <span id="mentors_avg_star_hint">
                <?= Votes::getAverageRatingStarHint($mentor_average_votes); ?>
              </span>
            <?php endif; ?>


            </div>

            <div class="panel-body">
                <div id="collapseMentorEvidenceReviews<?= $evidence->id ?>"  class="panel-collapse" aria-expanded="false">
                    <div class="">
                        <?php
                        $votes = $evidence->getVotes('Mentors');
                        ?>

                        <?php if(!$votes || sizeof($votes) <= 0): ?>
                            <p>
                                <?php echo Yii::t('MissionsModule.base', 'No mentor reviews'); ?>
                            </p>
                        <?php endif; ?>

                        <?php foreach($votes as $vote): ?>
                            <div class="review-box" style="position:relative">

                                <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors" || $vote->user->group->name == "Mentors"): ?>
                                    <img class="media-object img-rounded user-image user-<?php echo $vote->user->guid; ?>" alt="35x35"
                                         data-src="holder.js/35x35" style="display: inline-block;"
                                         src="<?php echo $vote->user->getProfileImage()->getUrl(); ?>"
                                         width="35" height="35"/>

                                    &nbsp;<a href="<?= ($vote->user->getUrl()) ?>">
                                        <?= ($vote->user->username) ?>
                                    </a>

                                    <?php echo Yii::t('MissionsModule.base', 'in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>

                                <?php else: ?>

                                    <?php echo Yii::t('MissionsModule.base', 'Anonymous in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>

                                <?php endif; ?>

                                <p style="padding:5px 10px 5px 45px"><?php echo $vote->comment; ?></p>

                                <?php if($vote->value > 0 ): ?>
                                    <div class="stars" style="text-align:left;">
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
                                    <label class="star_label" id="star_hint<?= $evidence->id ?>"><?= $vote->getStarHint(); ?></label><BR>
                                <?php else: ?>
                                  <div class="label-danger">
                                    <p style="color:#F4F4F4; text-align: center;"><?php echo Yii::t('MissionsModule.base', 'Does not meet rubric'); ?></p>
                                  </div>
                                <?php endif; ?>

                                <?php echo \humhub\modules\comment\widgets\CommentLink::widget(['object' => $vote, 'mode' => \humhub\modules\comment\widgets\CommentLink::MODE_INLINE]); ?>
                                <?php echo \humhub\modules\comment\widgets\Comments::widget(array('object' => $vote)); ?>

                                <div style="text-align: right">
                                  <?php
                                    $enable = "";
                                    $disable = "hidden";
                                    $disables = "hidden";

                                    if ($vote->quality == 1) {
                                        $enable = "hidden";
                                        $disable = "";
                                        $disables = "";

                                    }
                                  ?>

                                    <?php if(Yii::$app->user->isAdmin()): ?>
                                        <?php

                                          echo \humhub\widgets\AjaxButton::widget([
                                              'label' => Yii::t('MissionsModule.base', 'Mark as quality review'),
                                              'beforeSend' => new yii\web\JsExpression("function(html){  if(!confirm('".Yii::t('MissionsModule.base', 'Are you sure?')."')){return false;} }"),
                                              'ajaxOptions' => [
                                                  'type' => 'POST',
                                                  'success' => new yii\web\JsExpression('function(){
                                              $("#btn-enable-module-' . $vote->id . '").addClass("hidden");
                                              $("#btn-disable-module-' . $vote->id . '").removeClass("hidden");
                                              $("#btn-disables-module-' . $vote->id . '").removeClass("hidden");
                                              loadPopUps();
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
                                              'beforeSend' => new yii\web\JsExpression("function(html){  if(!confirm('".Yii::t('MissionsModule.base', 'Are you sure?')."')){return false;} }"),
                                              'ajaxOptions' => [
                                                  'type' => 'POST',
                                                  'success' => new yii\web\JsExpression('function(){
                                              $("#btn-enable-module-' . $vote->id . '").removeClass("hidden");
                                              $("#btn-disable-module-' . $vote->id . '").addClass("hidden");
                                              $("#btn-disables-module-' . $vote->id . '").addClass("hidden");
                                              loadPopUps();
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

                                    <?php else: ?>

                                      <div class="trophy-icon agent <?= $disables ?>" id="btn-disables-module-<?php echo $vote->id; ?>" style="position: absolute; top: 0; right: 10px;"><i class="fa fa-trophy fa-lg" aria-hidden="true"></i></div>

                                    <?php endif; ?>



                                </div>

                            </div>


                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a style="cursor: default" aria-expanded="false" class="collapsed">
                        <?= Yii::t('MissionsModule.base', 'Agent Reviews') ?>
                    </a>
                </h6>
            </div>

            <!-- if there's at least one review -->
            <?php if($agent_vote_count > 0): ?>
              <div class="tags_panel">

              <div class="row" style="margin-bottom:50px">
                    <?php foreach($tags as $key => $tag): ?>
                    <div class="col-sm-4">
                        <span><?= empty($tags[$key]['translation']) ? $tags[$key]['title'] : $tags[$key]['translation'] ?></span>
                        <span style="float:right"><?= $tags[$key]['amount'] ?></span>
                    </div>
                    <?php endforeach; ?>
              </div>

              <div class="users_avg_stars stars" title="<?= number_format((float)$user_average_votes, 2, '.', '') ?>">
                <?php for ($i = 0; $i < 5; $i++): ?>
                  <?php if ($user_average_votes > $i): ?>
                    <?php if (($user_average_votes - $i) < 1): ?>
                      <i class="fa fa-star-half-o fa-lg" aria-hidden="true"></i>
                    <?php else: ?>
                      <i class="fa fa-star fa-lg" aria-hidden="true"></i>
                    <?php endif; ?>
                  <?php else: ?>
                    <i class="fa fa-star-o fa-lg" aria-hidden="true"></i>
                  <?php endif; ?>
                <?php endfor; ?>
              </div>

              <span id="user_avg_star_hint">
                <?= Votes::getAverageRatingStarHint($user_average_votes); ?>
              </span>
            <?php endif; ?>

            </div>

            <div class="panel-body">
                <?php
                    $votes = $evidence->getVotes('Users');
                    $vote = array_shift($votes);
                    if($vote){
                      echo $this->render('user_vote_view', array('vote' => $vote, 'contentContainer' => $contentContainer));
                    }
                ?>
                <div id="collapseAgentEvidenceReviews<?= $evidence->id ?>"  class="panel-collapse collapse" aria-expanded="false">
                    <div class="">
                        <?php
                          foreach($votes as $vote){
                            echo $this->render('user_vote_view', array('vote' => $vote, 'contentContainer' => $contentContainer));
                          }
                        ?>
                    </div>
                </div>

            <br />
            <?php if($agent_vote_count > 1): ?>
              <a href="#collapseAgentEvidenceReviews<?= $evidence->id ?>"  class="btn btn-sm btn-primary " data-toggle="collapse">
                 <?= Yii::t('MissionsModule.base', 'Show {total_reviews} agent reviews', ['total_reviews' => $agent_vote_count - 1]) ?>
              </a>
            <?php elseif($agent_vote_count == 0): ?>
              <p>
                <?= Yii::t('MissionsModule.base', 'No agent reviews') ?>
              </p>
            <?php endif; ?>
            </div>
        </div>

    </div>

<!-- DRAFT -->
<?php else: ?>
    <?php

        $form = CActiveForm::begin(['id' => 'evidence-edit-form_' . $evidence->id]);

        echo Html::hiddenInput('activityId', $activity->id);

        echo $form->textArea($evidence, 'title', array('class' => 'form-control autosize contentForm', 'id' => 'evidence_input_title_' . $evidence->id, 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', 'Edit your Evidence title...')));
        echo $form->textArea($evidence, 'text', array('class' => 'text-margin form-control autosize contentForm count-chars', 'id' => 'evidence_input_text_' . $evidence->id, 'rows' => '10', "tabindex" => "2", 'pattern' => '.{0}|.{140,}', 'required' => true, 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', 'Edit your Evidence content...')));
        ?>

        <div id="counter" style="font-weight:bold">
            <span id="current<?= $evidence->id ?>"><?= mb_strlen($evidence->text) ?></span>
            <span id="minimun<?= $evidence->id ?>">/ 140</span>
        </div>

        <?php

        echo "<br>";
        echo "<div>";

        echo \humhub\widgets\AjaxButton::widget([
            'label' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Save Draft'),
            'ajaxOptions' => [
                'dataType' => 'json',
                'type' => 'POST',
                'success' => "loadPopUps()",
                'url' => $evidence->content->container->createUrl('/missions/evidence/update', ['id' => $evidence->id]),
            ],
            'htmlOptions' => [
                'class' => 'btn btn-primary btn-comment-submit',
                'id' => 'evidence_edit_post_' . $evidence->id,
                'type' => 'submit'
            ]
        ]);

        echo \humhub\widgets\AjaxButton::widget([
            'label' => Yii::t('MissionsModule.base', 'Publish'),
            'ajaxOptions' => [
                'dataType' => 'json',
                'type' => 'POST',
                'beforeSend' => "function() { validateDraft($evidence->id); }",
                'success' => "function(response) { entryHandleResponse(response);}",
                'url' => $evidence->content->container->createUrl('/missions/evidence/publish', ['id' => $evidence->id]),
            ],
            'htmlOptions' => [
                'class' => 'btn btn-success',
                'id' => 'evidence_publish_post_' . $evidence->id,
                'type' => 'submit'
            ]
        ]);

        echo humhub\modules\file\widgets\FileUploadButton::widget(array(
            'uploaderId' => 'post_upload_' . $evidence->id,
            'object' => $evidence
        ));

        ?>

    </div>

    <?php

         // Creates a list of already uploaded Files
        echo \humhub\modules\file\widgets\FileUploadList::widget(array(
            'uploaderId' => 'post_upload_' . $evidence->id,
            'object' => $evidence
        ));

        CActiveForm::end();

    ?>

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

$(document).ready(function(){

    console.log("changing entry handleResponse");

    entryHandleResponse = function(response) {
      console.log("calling handle response");
      handleResponse(response);
      if (!response.errors) {
          window.location.hash = "wallEntry_" + response.wallEntryId;

          //wait for handle response

          var timer = setInterval(function() {
                console.log("check duplicated");
                checkDuplicatedEntry();
                reLoadPopUps();
                updateEvocoins();
                window.clearInterval(timer);
                timer = null;
                }, 
          500); 

          
      }
    }

    current = $('#current<?= $evidence->id ?>');

    if(current.text() >= 140){
        current.css('color', '#92CE92')
    }else{
        current.css('color', '#9B0000')
    }


    $(".btn-hide<?= $evidence->id ?>").click(function(){
        $("#yes-opt<?= $evidence->id ?>").collapse('hide');
    });
    $(".btn-show<?= $evidence->id ?>").click(function(){
        $("#yes-opt<?= $evidence->id ?>").collapse('show');
    });
});

$('#evidence_input_text_<?= $evidence->id ?>').keyup(function() {

    current = $('#current<?= $evidence->id ?>');
    minimun = $('#minimun<?= $evidence->id ?>');

    //change current
    current.text($('#evidence_input_text_<?= $evidence->id ?>').val().length);

    if(current.text() >= 140){
        current.css('color', '#92CE92')
    }else{
        current.css('color', '#9B0000')
    }

})

function checkDuplicatedEntry(){
  var entries = $('[id="wallEntry_<?= $evidence->content->getFirstWallEntryId() ?>"]');
  if(entries.length >= 1){
    for(var i=1; i<entries.length; i++){
      entries[i].remove();
    }
  }
}

function validateDraft(draft_id){
  text = $('#evidence_input_text_' + draft_id);
  if(text.val().length < 140){
    showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Post too short.') ?>");
  }
}


function review(id, comment, opt, grade){
    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              if(xhttp.responseText == "success"){
                updateReview(id, opt, grade);
              }else{
                $("#review_tab_" + id).replaceWith(xhttp.responseText);
              }
            }
<<<<<<< HEAD
            reLoadPopUps();
=======
            loadPopUps();
>>>>>>> f5466e1a9a7dcb492a6d8e680f8e5fab835fe9ed
        }
    };

    <?php if ($is_ally): ?>
    xhttp.open("GET", "<?= $contentContainer->createUrl('/alliances/alliances/review'); ?>&opt="+opt+"&grade="+grade+"&evidenceId="+id+"&comment="+comment , true);
    <?php else: ?>

    xhttp.open("GET", "<?= $contentContainer->createUrl('/missions/evidence/review'); ?>&opt="+opt+"&grade="+grade+"&evidenceId="+id+"&comment="+comment , true);

    <?php endif; ?>

    xhttp.send();

    return false;
}

function validateReview(id){

  var opt = $('#review' + id).find('input[name="yes-no-opt'+id+'"]:checked'),
      grade = $('input[name="grade_'+id+'"]:checked'),
      comment = $("#review_comment_"+id).val();

  opt = opt? opt.val() : null;
  grade = grade? grade.val() : null;

  if(!comment){
    showMessage("Error", "<?= Yii::t('MissionsModule.base', 'Comment required') ?>");
    return false;
  }

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

jQuery(document).on('ajaxComplete', function () {
  var $forms    = $('form.review'),
      formCount = $forms.length,
      i         = 0;

  for (i; i < formCount; i++) {
    var id            = $forms[i].id.replace('review', ''),
        $form         = $('#review' + id),
        $submitButton = $('#post_submit_review' + id);

    $submitButton.off();
    $submitButton.on('click', function(e){
      var id  = e.target.id.replace('post_submit_review', ''),
          opt = $('#review' + id).find('input[name="yes-no-opt'+id+'"]:checked').val();

      if (opt == 'no') {
        if (confirm("<?php echo Yii::t('MissionsModule.base', 'Are you sure you want to submit this review?'); ?>")){
          $('#review' + id).submit(
              function(){
                  return validateReview(id);
              }
          );
        } else {
          e.preventDefault();
          return false;
        }
      } else {
        if (confirm("<?php echo Yii::t('MissionsModule.base', 'Are you ready to submit your review? You will not be able to change it after submitting.'); ?>")){
          $('#review' + id).submit(function(e){
            e.preventDefault();
            return validateReview(id);
          }
          );
        }else{
          e.preventDefault();
          return false;
        }
      }

    });
  }
});

</script>


<style>

/*
Reference:
https://www.everythingfrontend.com/posts/star-rating-input-pure-css.html
*/

.rating {
    overflow: hidden;
    display: inline-block;
    position: relative;
    font-size: 10pt !important;
}

</style>
