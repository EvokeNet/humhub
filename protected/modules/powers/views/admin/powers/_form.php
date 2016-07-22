<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="powers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'improve_multiplier') ?>

    <?= $form->field($model, 'improve_offset') ?>

    <?php echo $form->field($model, 'image')->fileInput(); ?>

    <?php if(!empty($model->image)): ?>

        <div class = "well">
            <label><?php $file = explode('uploads/', $model->image); echo Yii::t('NovelModule.base', 'Uploaded Image: {file}', array('file' => $file[0])); ?></label>
            <br><a href = "<?= $model->image ?>" target = "_blank"><img src = "<?= $model->image ?>" width = "200"></img></a>
        </div><br><br>

    <?php else: ?>

        <div class = "well">
            <span><?= Yii::t('NovelModule.base', 'No images uploaded yet') ?></span>
        </div><br>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('PowersModule.base', 'Create') : Yii::t('PowersModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
