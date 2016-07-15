<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="powers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'amount')->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('CoinModule.base', 'Create') : Yii::t('CoinModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
