<?php

use yii\helpers\Html;
use yii\helpers\Url;

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
	<img src="<?php echo Url::to('@web/themes/EvokeLiteracy/img/EvokeInfograhpic.png') ?>" style = "border: 3px solid #254054; margin-bottom:10px">
</div>

<div style="text-align:right; margin: 10px 40px">
<?php echo Html::a(
    Yii::t('StaticsModule.base', 'Next'),
    [$next_page_link], array('class' => 'btn btn-lg btn-cta1', 'style' => 'padding: 0 80px')); ?>
</div>
