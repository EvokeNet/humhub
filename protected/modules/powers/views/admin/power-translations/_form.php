<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\languages\models\Languages;


/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\PowerTranslations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="power-translations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'language_id')->dropdownList(
            ArrayHelper::map(Languages::find()->all(), 'id', 'language'),
            ['prompt' => 'Select Language']
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('PowersModule.base', 'Create') : Yii::t('PowersModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
