<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prizes-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'quantity')->input('number') ?>
    <?= $form->field($model, 'weight')->input('number') ?> <span><?php echo Yii::t('PrizeModule.base', 'weight explanation') ?></span>
    <?= $form->field($model, 'week_of')->widget(\yii\jui\DatePicker::className(),[
        'dateFormat' => 'yyyy-MM-dd',
      ]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

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

    <?php echo $form->field($model, 'description')->textArea(['rows' => 3]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('PrizeModule.base', 'Create') : Yii::t('PrizeModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
