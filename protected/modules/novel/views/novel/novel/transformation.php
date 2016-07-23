<?php

use yii\helpers\Html;
use app\modules\novel\models\NovelPage;

?>

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body text-center">
        <h1><?php echo Yii::t('NovelModule.base', 'Congratulations!') ?></h1>
          <span><?php echo Yii::t('NovelModule.base', 'You earned') ?></span>
          <div class="">
            <strong><?php echo $points ?> pts</strong>
          </div><span><?php echo Yii::t('NovelModule.base', 'in Transformation') ?></span>
        </br>
        </br>
        <p>
          <?php echo Yii::t('NovelModule.base', 'You have taken your first steps as an agent of Evoke and have already demonstrated your power of transformation. Please take a few moments to complete your profile and see what other innate abilities you have.') ?>
        </p>
        <?php echo Html::a(
            Yii::t('NovelModule.base', 'Complete Your Profile'),
            ['/matching_questions/matching-questions/matching'], array('class' => 'btn btn-success')); ?>
      </div>
    </div>
  </div>
</div>
