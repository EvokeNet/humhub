
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
  <?php endif; ?>
</div>
