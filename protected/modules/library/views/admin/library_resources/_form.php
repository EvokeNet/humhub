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
    <?php echo $form->field($model, 'link') ?>
    <?php echo $form->field($model, 'description')->textArea(['rows' => 3]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MarketplaceModule.base', 'Create') : Yii::t('MarketplaceModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
