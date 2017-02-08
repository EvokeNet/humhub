
<?php

use yii\helpers\Html;
use humhub\libs\Helpers;
use humhub\models\Setting;
use yii\helpers\Url;
use yii\web\JsExpression;
use humhub\compat\CActiveForm;

?>

<div class="review-box" id="vote_tab_<?= $vote->id ?>">
  
  <?php if(Yii::$app->user->getIdentity()->group->name == "Mentors" || $vote->user->group->name == "Mentors"): ?>
    <img class="media-object img-rounded user-image user-<?php echo $vote->user->guid; ?>" alt="40x40"
         data-src="holder.js/40x40" style="display: inline-block;"
         src="<?php echo $vote->user->getProfileImage()->getUrl(); ?>"
         width="40" height="40"/>

    &nbsp;<a href="<?= ($vote->user->getUrl()) ?>">
        <?= ($vote->user->username) ?>
    </a>

    <?php echo Yii::t('MissionsModule.base', 'in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>

    <?php 
    if($vote->user_id == Yii::$app->user->getIdentity()->id){
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

  <?php else: ?>
    <?php echo Yii::t('MissionsModule.base', 'Anonymous in {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?>
  <?php endif; ?>

  <p style="margin:20px 0"><?php echo $vote->comment; ?></p>
  
  <?php if($vote->value > 0 ): ?>

    <div class="stars" style="text-align:left;">
        <label id="star_hint"></label><BR>
        <?php for ($i = 0; $i < 5; $i++): ?>
        <?php if ($vote->value > $i): ?>
        <?php if (($vote->value - $i) < 1): ?>
        <i class="fa fa-star-half-o" aria-hidden="true"></i>
      <?php else: ?>
      <i class="fa fa-star" aria-hidden="true"></i>
    <?php endif; ?>
    <?php else: ?>
      <i class="fa fa-star-o" aria-hidden="true"></i>
    <?php endif; ?>
    <?php endfor; ?>
    </div>

  <?php else: ?>

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

      <div class="trophy-icon <?= $disables ?>" id="btn-disables-module-<?php echo $vote->id; ?>"><i class="fa fa-trophy fa-lg" aria-hidden="true"></i></div>
      
      <?php endif; ?>
    </div>
  </div>

<script>


</script>