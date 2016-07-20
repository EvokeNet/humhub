<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\EvokationDeadline */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evokation-deadline-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>
    
    <?= $form->field($model, 'finish_date')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd'
    ]) ?>
 
    <?php
    
        // echo $form->field($model, 'start_date')->widget(\janisto\timepicker\TimePicker::className(), [
        //     //'language' => 'fi',
        //     'mode' => 'datetime',
        //     'clientOptions'=>[
        //         'dateFormat' => 'yy-mm-dd',
        //         'timeFormat' => 'HH:mm:ss',
        //         'showSecond' => true,
        //     ]
        // ]);

    ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
