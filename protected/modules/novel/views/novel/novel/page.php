<?php

use yii\helpers\Html;
use app\modules\novel\models\NovelPage;


?>
<style media="screen">
  .graphic-novel-page{
    min-height:200vh;
    background-image:url('<?= $page->page_image ?>');
    background-size:contain;
    background-repeat:no-repeat;
    background-position:center;
  }

  .graphic-novel-page .page-button{
    top: 50%;
    font-size:2em;
    position: fixed;
    width: 2em;
    text-align: center;
    line-height: 2em;
    background-color: #1ecccc;
    border: 2px solid #254054;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    border-radius: 1em;
  }

  .graphic-novel-page .page-button:hover{
    background-color: #333;
  }

  .graphic-novel-page .button-back{
    left: 1em;
  }
  .graphic-novel-page .button-next{
    right: 1em;
  }
</style>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
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
