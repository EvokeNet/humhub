<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\novel\models\NovelPage;

?>
<style media="screen">

  .graphic-novel-page{
    /*min-height:200vh;*/

    <?php if($page->markup != ""): ?>
    <?php else: ?>
    background-image:url('<?= $page->page_image ?>');
    <?php endif; ?>

    background-size:contain;
    background-repeat:no-repeat;
    background-position:top;
    width: 100%;
    height: 0;
    padding-top: 70%!important;
  }
  
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
    
    <?php if($page->chapter): ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="alchemy">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/alchemy.png') ?>" alt="alchemy" width=50 height=50 />
          </div>
          <b>
            <?php echo Yii::t('NovelModule.base', 'Mission') ?> <?= $page->chapter->mission->position ?>, <?php echo Yii::t('NovelModule.base', 'Chapter') ?> <?= $page->chapter->number ?>
          </b>
        </div>
      </div>
    <?php endif; ?>
    

    <div class="panel panel-default">
      <div class="panel-body graphic-novel-page" style="">
        <?= $page->markup ?>
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
