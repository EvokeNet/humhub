<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="powers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'quantity')->input('number') ?>
    <?= $form->field($model, 'weight')->input('number') ?>
    <?= $form->field($model, 'week_of')->widget(\yii\jui\DatePicker::className(),[
        'dateFormat' => 'yyyy-MM-dd',
      ]) ?> <span><?php Yii::t('PrizeModule.base', 'This should be the begining of the week for this prize') ?>This should be the begining of the week for this prize.</span>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('PrizeModule.base', 'Create') : Yii::t('PrizeModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
