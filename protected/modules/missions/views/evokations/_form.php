<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Evokations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evokations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'youtube_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gdrive_url')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'created_by')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <?php // $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
