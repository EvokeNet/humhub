<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\modules\matching_questions\models\Qualities;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\TagTranslations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tag-translations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_headline')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'quality_id')->dropdownList(
            ArrayHelper::map(Qualities::find()->all(), 'id', 'name'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Super Power')]
        ) ?>

    <?= $form->field($model, 'level_id')->dropdownList(
            array('1' => 1, '2' => 2, '3' => 3, '4' => 4),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Level')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
