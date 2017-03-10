
<?php

use yii\helpers\Html;
use humhub\libs\Helpers;
use humhub\models\Setting;
use yii\helpers\Url;
use yii\web\JsExpression;
use humhub\compat\CActiveForm;

?>

<div class="review-box" id="vote_tab_<?= $vote->id ?>" style="position:relative">
  
  <?php // Deactivated if(Yii::$app->user->getIdentity()->group->name == "Mentors" || $vote->user->group->name == "Mentors"): ?>
  <?php if(true): ?>
    <img class="media-object img-rounded user-image user-<?php echo $vote->user->guid; ?>" alt="35x35"
         data-src="holder.js/35x35" style="display: inline-block;"
         src="<?php echo $vote->user->getProfileImage()->getUrl(); ?>"
         width="35" height="35"/>

    &nbsp;<a href="<?= ($vote->user->getUrl()) ?>">
        <?= ($vote->user->username) ?>
    </a>

    <?php echo Yii::t('MissionsModule.base', 'in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>

    <?php 
    // deactivated, remove false condition to activate it again
    if(false && $vote->user_id == Yii::$app->user->getIdentity()->id && Yii::$app->user->getIdentity()->group->name == "Mentors"){
      echo \humhub\widgets\AjaxButton::widget([
      'label' => Yii::t('MissionsModule.base', 'Edit'),
      'ajaxOptions' => [
      'type' => 'POST',
      'success' => new yii\web\JsExpression('function(response){
        $("#vote_tab_'. $vote->id .'").replaceWith(response);
      }'),
      'url' => $contentContainer->createUrl('/missions/evidence/edit_review', ['id' => $vote->evidence->id]),
      ],
      'htmlOptions' => [
      'class' => 'btn btn-sm btn-primary',
      'id' => 'btn-edit-' . $vote->id
      ]
      ]);
    }
    ?>

    <?php if($vote->value > 0 ): ?>

      <div class="stars" style="display:inline; margin-left:50px">
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

      <!--<span id="user_avg_star_hint"><?= $vote->getStarHint(); ?></span>-->

    <?php endif; ?>

  <?php else: ?>
    <?php echo Yii::t('MissionsModule.base', 'Anonymous in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>
  <?php endif; ?>

  <p style="padding:5px 10px 5px 45px"><?php echo $vote->comment; ?></p>
  
  <?php if($vote->value == 0 ): ?>

    <div class="label-danger">
      <p style="color:#F4F4F4; text-align: center;"><?php echo Yii::t('MissionsModule.base', 'Does not meet rubric'); ?></p>
    </div>

  <?php endif; ?>

  <div style="text-align: right">
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
      'beforeSend' => new yii\web\JsExpression("function(html){  if(!confirm('".Yii::t('MissionsModule.base', 'Are you sure?')."')){return false;} }"),
      'success' => new yii\web\JsExpression('function(){
        $("#btn-enable-module-' . $vote->id . '").addClass("hidden");
        $("#btn-disable-module-' . $vote->id . '").removeClass("hidden");
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
        'beforeSend' => new yii\web\JsExpression("function(html){  if(!confirm('".Yii::t('MissionsModule.base', 'Are you sure?')."')){return false;} }"),
        'success' => new yii\web\JsExpression('function(){
          $("#btn-enable-module-' . $vote->id . '").removeClass("hidden");
          $("#btn-disable-module-' . $vote->id . '").addClass("hidden");
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
      
      <?php endif; ?>
    </div>
  </div>

<script>


</script>