<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\matching_questions\models\MatchingAnswersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matching-answers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'matching_question_id') ?>

    <?= $form->field($model, 'social_innovator_quality_id') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('MatchingModule.base', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('MatchingModule.base', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
