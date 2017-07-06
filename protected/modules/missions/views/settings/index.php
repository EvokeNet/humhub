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
        <?php echo $form->field($model, 'enabled_psychometric_questionnaire_obligation')->checkbox(); ?>
        <?php echo $form->field($model, 'enabled_novel_read_obligation')->checkbox(); ?>
        <?php 

            if($model->enabled_psychometric_questionnaire_obligation && $model->enabled_novel_read_obligation){
                echo $form->field($model, 'novel_order')->checkbox();     
            }
            
        ?>
        <hr>
        <?php echo $form->field($model, 'investment_limit')->textInput( ['style' => 'width: 80px;'])->hint(Yii::t('MissionsModule.base', 'Set 0 or empty for unlimited evocoins.')) ; ?>

        <hr>

        <?php echo CHtml::submitButton(Yii::t('AdminModule.views_setting_index', 'Save'), array('class' => 'btn btn-primary')); ?>

        <!-- show flash message after saving -->
        <?php \humhub\widgets\DataSaved::widget(); ?>

        <?php ActiveForm::end(); ?>

    </div>
</div>

