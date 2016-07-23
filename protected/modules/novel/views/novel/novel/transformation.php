<?php

use yii\helpers\Html;
use app\modules\novel\models\NovelPage;

?>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body text-center">
        <h1><?php echo Yii::t('NovelModule.base', 'Congratulations!') ?></h1>
          <span><strong><?php echo Yii::t('NovelModule.base', 'You earned {points} points in Transformation', array('points' => $points)) ?></strong></span>
          
        </br>
        </br>
        <p>
          <?php echo Yii::t('NovelModule.base', 'This power has been evident since the network found you. Now we will discover the other powers you have and which so far have not been so evident.') ?>
        </p>
        <?php echo Html::a(
            Yii::t('NovelModule.base', 'Discover Your Powers'),
            ['/matching_questions/matching-questions/matching'], array('class' => 'btn btn-success')); ?>
      </div>
    </div>
  </div>
</div>
