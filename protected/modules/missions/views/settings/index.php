<?php

use humhub\compat\CHtml;
use humhub\models\Setting;
use yii\widgets\ActiveForm;

?>

<div class="panel panel-default">
    <div
        class="panel-heading">
            <?php echo Yii::t('MissionsModule.base', '<strong>Evoke</strong> settings'); ?>
        </div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin(); ?>

        <strong><?php echo Yii::t('AdminModule.views_setting_index', 'Dashboard'); ?></strong>
        <br>
        <br>
        <?php echo $form->field($model, 'enabled_evokations')->checkbox(); ?>
        <?php echo $form->field($model, 'enabled_evokation_page_visibility')->checkbox(); ?>

        <hr>

        <?php echo CHtml::submitButton(Yii::t('AdminModule.views_setting_index', 'Save'), array('class' => 'btn btn-primary')); ?>

        <!-- show flash message after saving -->
        <?php \humhub\widgets\DataSaved::widget(); ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>

