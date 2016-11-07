
<?php

use yii\helpers\Html;
use humhub\libs\Helpers;
use humhub\models\Setting;
use yii\helpers\Url;
use yii\web\JsExpression;
use humhub\compat\CActiveForm;

?>
<div id="vote_tab_<?= $vote->id ?>" style = "padding: 10px 10px 3px; margin-bottom: 20px; border: 3px solid #9013FE; word-wrap: break-word;">
  <p><?php echo Yii::t('MissionsModule.base', 'Comment: {comment}', array('comment' => $vote->comment)); ?></p>
  <?php if($vote->value > 0 ): ?>
  <div class="stars" style="text-align:left;">
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
  <p style="color:red"><?php echo Yii::t('MissionsModule.base', 'Does not meet rubric'); ?></p>
<?php endif; ?>

<?php if(Yii::$app->user->getIdentity()->group->name == "Mentors" || $vote->user->group->name == "Mentors"): ?>
  <p><?php echo Yii::t('MissionsModule.base', 'By'); ?>
    <a href="<?= ($vote->user->getUrl()) ?>">
      <?= ($vote->user->username) ?>
    </a>,
    <?php echo \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]); ?></p>

    <?php echo \humhub\widgets\AjaxButton::widget([
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
    ?>

  <?php else: ?>
  <p><?php echo Yii::t('MissionsModule.base', 'By Anonymous, {time}', array('time' => \humhub\widgets\TimeAgo::widget(['timestamp' => $vote->created_at]))); ?></p>
<?php endif; ?>


  <div style="margin:20px 0 10px">
    <?php if(Yii::$app->user->isAdmin()): ?>
    <?php

    $enable = "";
    $disable = "hidden";

    if ($vote->quality == 1) {
      $enable = "hidden";
      $disable = "";
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

      <?php endif; ?>
    </div>
  </div>