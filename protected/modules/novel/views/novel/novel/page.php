<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\novel\models\NovelPage;

?>
<style media="screen">
  
  <?php if (!Yii::$app->user->getIdentity()->has_read_novel && Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
    .topbar, .footer {
      display: none;
    }

    body {
      padding-top: 1em;
    }
  <?php endif; ?>
  
</style>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <?php if ($page->page_number === 1 && !Yii::$app->user->getIdentity()->has_read_novel && Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="alchemy">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/alchemy.png') ?>" alt="alchemy" width=50 height=50 />
          </div>
          <p><strong><?php echo Yii::$app->user->getIdentity()->username ?>:</strong>&nbsp;
<?php echo Yii::t('NovelModule.base', 'novel intro') ?></p>
        </div>
      </div>
    <?php endif; ?>
    <div class="panel panel-default">
      <div class="panel-body graphic-novel-page" style="">
        <?php if ($page->page_number !== 1): ?>
          <?php echo Html::a(
              '<',
              ['graphic-novel', 'page' => ($page->page_number - 1)], array('class' => 'button-back page-button')); ?>
        <?php endif; ?>
        <?php echo Html::a(
            '>',
            ['graphic-novel', 'page' => ($page->page_number + 1)], array('class' => 'button-next page-button')); ?>

      </div>
    </div>
  </div>
</div>
