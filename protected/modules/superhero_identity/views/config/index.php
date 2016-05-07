<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\compat\CActiveForm;
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('SuperheroIdentityModule.base', 'Superhero Identity Module Configuration'); ?></div>
    <div class="panel-body">
        <p><?php echo Yii::t('SuperheroIdentityModule.base', "There's nothing here."); ?></p>
        <br/>
        <a class="btn btn-default" href="<?php echo Url::to(['/admin/module']); ?>"><?php echo Yii::t('SuperheroIdentityModule.base', 'Back to modules'); ?></a>
    </div>
</div>