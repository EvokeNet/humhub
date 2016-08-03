<?php

use yii\helpers\Html;
use app\modules\novel\models\NovelPage;

?>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body text-center">
        <h1><?php echo Yii::t('NovelModule.base', 'Congratulations!') ?></h1><br>
        <h4><?php echo Yii::t('NovelModule.base', "As you can see, Marta's story continues. She, like you, is committed to creating change in her community. Because of your commitment you have received {points} points in the power of Transformation.<br><br>This power has been evident since the network found you. Now we will discover the other powers you have and which so far have not been so evident.", array('points' => $points)) ?></h4>
        <br>
        <?php echo Html::a(
            Yii::t('NovelModule.base', 'Discover Your Powers'),
            ['/matching_questions/matching-questions/matching'], array('class' => 'btn btn-cta1')); ?>
      </div>
    </div>
  </div>
</div>

<style media="screen">
  .topbar {
    display: none;
  }

  body {
    padding-top: 1em;
  }
</style>
