<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\Qualities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qualities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?php if(!empty($model->image)): ?>
        
        <div class = "well">
            <label><?php $file = explode('uploads/', $model->image); echo Yii::t('PowersModule.base', 'Uploaded Image: {file}', array('file' => $file[0])); ?></label>
            <br><a href = "<?= $model->image ?>" target = "_blank"><img src = "<?= $model->image ?>" width = "200"></img></a> 
        </div><br><br>
    
    <?php else: ?>
    
        <div class = "well">
            <span><?= Yii::t('PowersModule.base', 'No images uploaded yet') ?></span>
        </div><br>
    
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MatchingModule.base', 'Create') : Yii::t('MatchingModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
