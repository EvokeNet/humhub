<?php

use yii\helpers\Html;
use humhub\modules\space\models\Space;
use yii\helpers\Url;
use app\modules\teams\models\Team;
use app\modules\missions\models\Votes;
use app\modules\missions\models\Evidence;

$activity = null;

$user = Yii::$app->user->getIdentity();

if($user->group->name == "Mentors"){
  $title = Yii::t('MissionsModule.base', 'Review Evidences');
} else{
  $title = Yii::t('MissionsModule.base', 'Tag Evidences');
}

$this->pageTitle = $title;

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 style="margin-top:10px"><?php echo Yii::t('AlliancesModule.base', 'Review Ally Evidence'); ?></h4>
        <?php if($activity): ?>
        <h6><?php echo Yii::t('MissionsModule.base', '{first} of {total}', array('first' => ($evidence_count - $evidence_to_review_count + 1), 'total' => $evidence_count)); ?></h6>
        <?php endif; ?>
    </div>
    <div class="panel-body">
      <ul class="media-list">
        <?php foreach ($allies as $ally): ?>
          <li class="with-sub-list">
              <div class="media">
                <?php $space = Space::findOne($ally->id) ?>

                  <!-- Evidence Count -->
                  <div class="pull-right">
                      <strong><?php echo Yii::t('MissionsModule.base', 'Reviewed'); ?>:</strong>
                      <?php echo $ally->getReviewedEvidenceCount($user->id); ?>
                      &nbsp;/&nbsp;
                      <?php echo $ally->getEvidenceCount();?>
                  </div>

                  <?php echo \humhub\modules\space\widgets\Image::widget([
                      'space' => $space,
                      'width' => 40,
                      'htmlOptions' => [
                          'class' => 'media-object img-rounded',
                      ],
                      'link' => 'true',
                      'linkOptions' => [
                          'class' => 'pull-left',
                      ],
                  ]); ?>

                  <div class="media-body">
                      <h4 class="media-heading"><a href="<?php echo $ally->getUrl(); ?>" class="link-text"><?php echo Html::encode($ally->name); ?></a></h4>
                      <span><?php echo Yii::t('MissionsModule.base', 'Description: {description}', array('description' => Html::encode(humhub\libs\Helpers::truncateText($ally->description, 100)))); ?></span>
                  </div>
              </div>

              <?php $ally_members = $ally->getTeamMembers(); ?>
              <br />
              <ul class="media-list">
                <?php foreach ($ally_members as $ally_member): ?>
                  <a href="<?php echo $ally_member->getUrl(); ?>">
                    <li class="link">
                        <?php echo $ally_member->username; ?>
                        <div class="pull-right">
                          <strong><?php echo Yii::t('MissionsModule.base', 'Reviewed'); ?>:</strong>
                          <?php echo Votes::getReviewCountByUsers($user->id, $ally_member->id); ?>
                          &nbsp;/&nbsp;
                          <?php echo Evidence::getEvidenceCountForUser($ally_member->id); ?>
                        </div>
                    </li>
                  </a>
                <?php endforeach; ?>
              </ul>


          </li>
        <?php endforeach; ?>
      </ul>
    </div>
</div>

<style media="screen">
  .link {
    cursor: pointer;
  }

  .media-list li.with-sub-list:hover {
    background-color: #fff;
    border-left: 1px solid #EDEDED;
  }

  .link-text:hover {
    border-bottom: 1px dotted #000;
  }
</style>
