<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\powers\models\Powers;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\ActivityPowers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-powers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'power_id')->dropdownList(
            ArrayHelper::map(Powers::find()->all(), 'id', 'title'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Power')]
        ) ?>
    
    <?= $form->field($model, 'flag')->dropDownList([
            0 => Yii::t('MissionsModule.base', 'Primary Power'), 
            1 => Yii::t('MissionsModule.base', 'Secondary Power')
            ], ['prompt'=> Yii::t('MissionsModule.base', 'Select Option')]
        ) ?>
            
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
