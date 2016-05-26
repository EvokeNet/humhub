<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\powers\models\Powers;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\QualityPowers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quality-powers-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'power_id')->dropdownList(
            ArrayHelper::map(Powers::find()->all(), 'id', 'title'),
            ['prompt' => Yii::t('MatchingModule.base', 'Select Power')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MatchingModule.base', 'Create') : Yii::t('MatchingModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
