<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\MatchingQuestions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matching-questions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_code')->textarea(['rows' => 1]) ?>
    
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'type')->textInput(['maxlength' => true]) ?>
    
    <?php 
    echo $form->field($model, 'type')->dropDownList([
        'order' => Yii::t('MatchingModule.base', 'Order'), 
        'single-choice' => Yii::t('MatchingModule.base', 'Single Choice')
        ],['prompt'=>'Select Option']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MatchingModule.base', 'Create') : Yii::t('MatchingModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
