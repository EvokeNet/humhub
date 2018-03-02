<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\languages\models\Languages;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\TagTranslations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-translations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'answer_headline')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'right_answer')->dropdownList(
            array('0' => 'True', '1' => 'False'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select if answer is true or false')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
