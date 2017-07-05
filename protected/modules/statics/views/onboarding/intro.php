<?php

use yii\helpers\Html;

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

<h4 style="background-color: #101C2A; text-align: center; padding: 10px 0; margin: 0px 0 20px; color: #5aa2c6;"><?php echo Yii::t('StaticsModule.base', 'INTRODUCTION') ?></h4>

<div style="text-align:center; margin: 20px 0">
	<img src="https://about.canva.com/wp-content/uploads/sites/3/2015/01/timeline_infographic.png" />
</div>

<div style="text-align:right; margin: 10px 40px">
<?php echo Html::a(
    Yii::t('StaticsModule.base', 'Next'),
    ['/statics/onboarding/video'], array('class' => 'btn btn-lg btn-cta1', 'style' => 'padding: 0 80px')); ?>
</div>
