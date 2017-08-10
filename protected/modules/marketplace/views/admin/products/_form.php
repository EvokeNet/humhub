<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php echo $form->field($model, 'name') ?>
    <?php echo $form->field($model, 'quantity')->input('number') ?>
    <?php echo $form->field($model, 'price')->input('number') ?>
    <?php echo $form->field($model, 'image')->fileInput() ?>
    <?php echo $form->field($model, 'description')->textArea(['rows' => 3]); ?>


    <?php if(!empty($model->image)): ?>

        <div class = "well">
            <label><?php $file = explode('uploads/', $model->image); echo Yii::t('MarketplaceModule.base', 'Uploaded Image: {file}', array('file' => $file[0])); ?></label>
            <br><a href = "<?= $model->image ?>" target = "_blank"><img src = "<?= $model->image ?>" width = "200"></img></a>
        </div><br><br>

    <?php else: ?>

        <div class = "well">
            <span><?= Yii::t('MarketplaceModule.base', 'No images uploaded yet') ?></span>
        </div><br>

    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MarketplaceModule.base', 'Create') : Yii::t('MarketplaceModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
