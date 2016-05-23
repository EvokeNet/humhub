<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\MatchingAnswers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matching-answers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_code')->textarea(['rows' => 1]) ?>
    
    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_innovator_quality_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MatchingModule.base', 'Create') : Yii::t('MatchingModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
