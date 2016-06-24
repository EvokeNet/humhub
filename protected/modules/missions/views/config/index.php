<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\compat\CActiveForm;
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('MissionsModule.base', 'Missions Module Configuration'); ?></div>
    <div class="panel-body">


        <p><?php echo Yii::t('MissionsModule.base', 'Nothing here.'); ?></p>
        <br/>

        <?php $form = CActiveForm::begin(); ?>

        <div class="form-group">
        </div>

        <hr>
        
        <a class="btn btn-default" href="<?php echo Url::to(['/admin/module']); ?>"><?php echo Yii::t('BirthdayModule.base', 'Back to modules'); ?></a>

        <?php CActiveForm::end(); ?>
    </div>
</div>