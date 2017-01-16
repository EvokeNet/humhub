<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Missions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="missions-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'id_code')->textarea(['rows' => 1]) ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'locked')->dropDownList(['0' => 'Unlocked', '1' => 'Locked'], ['prompt' => 'Select Option']) ?>
    
    <?= $form->field($model, 'position')->textarea(['rows' => 1]) ?>
                 
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MissionsModule.base', 'Create') : Yii::t('MissionsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
