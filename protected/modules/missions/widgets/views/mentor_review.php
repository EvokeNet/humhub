<?php
use yii\helpers\Html;
use humhub\libs\Helpers;
use humhub\models\Setting;
use yii\helpers\Url;
use yii\web\JsExpression;
use humhub\compat\CActiveForm;
?>

<div class="panel-group" id="review_tab_<?= $evidence->id ?>">
  <div class="panel panel-default">
    <div class="panel-heading">
          <h6 class="panel-title">
            <a data-toggle="collapse" href="#collapseEvidence<?= $evidence->id ?>">
              <?= Yii::t('MissionsModule.base', 'Review') ?>
            </a>
          </h6>
    </div>

    <div id="collapseEvidence<?= $evidence->id ?>" class="panel-collapse collapse in">
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
      <div class="panel-body">
        <?php
          $primaryPowerTitle = $activity->getPrimaryPowers()[0]->getPower()->title;

          if(Yii::$app->language == 'es' && isset($activity->getPrimaryPowers()[0]->getPower()->powerTranslations[0]))
              $primaryPowerTitle = $activity->getPrimaryPowers()[0]->getPower()->powerTranslations[0]->title;
        ?>

        <h4 style="color:#FEAE1B"><?= Yii::t('MissionsModule.base', 'Distribute points for {title}', array('title' => $primaryPowerTitle)) ?></h4>

        <p><?= Yii::t('MissionsModule.base', 'Rubric: {text}', array('text' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></p><br />

        <form id = "review<?= $evidence->id ?>" class="review">
          <div class="radio">
            <label>
              <input id="yes-input<?= $evidence->id ?>" type="radio" name="yes-no-opt<?= $evidence->id ?>" class="btn-show<?= $evidence->id ?>" value="yes" <?= $yes ?> >
              Yes
            </label >                 
            <div id="yes-opt<?= $evidence->id ?>" class="radio">
              <span class="rating">
                  <?php for ($x=5; $x >= 1; $x--): ?>
                    <input id="grade<?= $x ?>_<?= $evidence->id ?>" onClick="$('#yes-input<?= $evidence->id ?>').prop('checked', true)" type="radio" name="grade_<?= $evidence->id ?>" class="rating-input" value="<?= $x?>" <?= $x == $grade ? 'checked' : '' ?> />
                    <label for ="grade<?= $x ?>_<?= $evidence->id ?>" class="rating-star"></label>
                  <?php endfor; ?>
              </span>
              <p>
                <?= Yii::t('MissionsModule.base', 'How many points will you award this evidence?') ?>
              </p>
            </div>
          </div>
          <div class="radio">
            <label>
            <input type="radio" name="yes-no-opt<?= $evidence->id ?>" onClick="$('#yes-opt<?= $evidence->id ?>').find('input').prop('checked', false)" value="no" <?= $no ?>>
             No
            </label>
          </div>
          <br>
          <?php echo Html::textArea("text", $comment , array('id' => 'review_comment_'.$evidence->id, 'class' => 'text-margin form-control count-chars ', 'rows' => '5', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.base', "Leave a comment and earn an additional 5 Evocoins."))); ?>
          <br>

          <br>
          <button type="submit" id="post_submit_review<?= $evidence->id ?>" class="btn btn-cta1 submit">
            <?= Yii::t('MissionsModule.base', 'Submit Review') ?>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>