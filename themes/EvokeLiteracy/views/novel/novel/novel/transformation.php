<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\novel\models\NovelPage;

?>

<div class="row">
  <div class="col-xs-8 col-xs-offset-2">
    <div class="panel panel-default">
      <div class="panel-body text-center">
        <img src="<?php echo Url::to('@web/themes/Evoke/img/alchemy.png') ?>" width = "120px" style = "border-radius: 50%; border: 3px solid #254054; margin-bottom:10px">
        <h4>Like you, Andre has the power of Transformation. That's why we have awarded you 90 points in that Power. You have always had this power. Now it is time to discover your other hidden powers.</h4>
        <br>
        <?php echo Html::a(
            Yii::t('NovelModule.base', 'Discover Your Powers'),
            ['/matching_questions/matching-questions/matching'], array('class' => 'btn btn-cta1')); ?>
      </div>
    </div>
  </div>
</div>

<style media="screen">
  .topbar, .footer {
    display: none;
  }

  body {
    padding-top: 1em;
  }
</style>
