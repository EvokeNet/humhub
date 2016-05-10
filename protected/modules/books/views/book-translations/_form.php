<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\languages\models\Languages;

/* @var $this yii\web\View */
/* @var $model app\modules\books\models\BookTranslations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-translations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'book_id')->textInput() ?>
    
    <?= $form->field($model, 'language_id')->dropdownList(
            ArrayHelper::map(Languages::find()->all(), 'id', 'code'),
            ['prompt' => 'Select Language']
        ) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abstract')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
