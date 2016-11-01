<?php

use yii\helpers\Html;
use humhub\modules\space\models\Space;
use yii\helpers\Url;

$teams_count = count($teams);

$activity = null;

$this->pageTitle = Yii::t('MissionsModule.event', 'Review Evidences');
$user = Yii::$app->user->getIdentity();

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 style="margin-top:10px"><?php echo Yii::t('MissionsModule.base', 'Review Evidence'); ?></h4>
        <?php if($activity): ?>
        <h6><?php echo Yii::t('MissionsModule.base', '{first} of {total}', array('first' => ($evidence_count - $evidence_to_review_count + 1), 'total' => $evidence_count)); ?></h6>
        <?php endif; ?>
    </div>
    <div class="panel-body">
      <ul class="media-list">

          <?php if($teams_count <= 0): ?>
              <div class="panel-body">

                  <?php if($this->context->action->actionMethod === "actionMyteams"): ?>
                      <h5><?php echo Yii::t('MissionsModule.mentor', 'Oops, there is no team here yet.'); ?></h5>
                      <h5><?php echo Yii::t('MissionsModule.mentor', 'Follow a team to add it to the list.'); ?></h6>
                      <br>
                      <h5>
                          Go to the
                          <a href="<?= Url::to(['/missions/mentor/teams']) ?>">teams page</a> and start following a team.
                      </h5>
                  <?php elseif($this->context->action->actionMethod === "actionTeams"): ?>
                      <h5><?php echo Yii::t('MissionsModule.mentor', 'Oops, there is no team here yet.'); ?></h5>
                  <?php endif; ?>

              </div>
          <?php endif; ?>

          <?php foreach ($teams as $team) : ?>
             <li>
                  <?php $space = Space::findOne($team->id) ?>

                  <!-- Evidence Count -->
                  <div class="pull-right">
                      <?php echo $team->getEvidenceCount();?>
                      <?php echo $team->getReviewedEvidenceCount($user->id); ?>
                  </div>

                  <div class="media">
                      <?php echo \humhub\modules\space\widgets\Image::widget([
                          'space' => $space,
                          'width' => 50,
                          'htmlOptions' => [
                              'class' => 'media-object',
                          ],
                          'link' => 'true',
                          'linkOptions' => [
                              'class' => 'pull-left',
                          ],
                      ]); ?>

                      <div class="media-body">
                          <h4 class="media-heading"><a
                                  href="<?php echo $team->getUrl(); ?>"><?php echo Html::encode($team->name); ?></a>
                          </h4>
                          <h5><?php echo Html::encode(humhub\libs\Helpers::truncateText($team->description, 100)); ?></h5>

                          <?php $tag_count = 0; ?>
                          <?php if ($team->hasTags()) : ?>
                              <?php foreach ($team->getTags() as $tag): ?>
                                  <?php if ($tag_count <= 5) { ?>
                                      <?php echo Html::a(Html::encode($tag), ['/directory/directory/spaces', 'keyword' => $tag], array('class' => 'label label-default')); ?>
                                      <?php
                                      $tag_count++;
                                  }
                                  ?>
                              <?php endforeach; ?>
                          <?php endif; ?>

                      </div>
                  </div>

              </li>
          <?php endforeach; ?>

          <?php if($teams_count > 0): ?>
              <div class="panel-body">

                  <?php if($this->context->action->actionMethod === "actionMyteams"): ?>
                      <div><?php echo Yii::t('MissionsModule.mentor', 'Follow a team to add it to the list.'); ?></div>
                      <br>
                      <div>
                          Go to the
                          <a href="<?= Url::to(['/missions/mentor/teams']) ?>">teams page</a> and start following a team.
                      </div>
                  <?php endif; ?>

              </div>
          <?php endif; ?>

      </ul>
    </div>
</div>
