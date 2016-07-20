<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\modules\missions\models\Missions;
use app\modules\missions\models\DifficultyLevels;
use app\modules\missions\models\EvokationCategories;

/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\Objectives */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activities-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'id_code')->textarea(['rows' => 1]) ?>
    
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'rubric')->textarea(['rows' => 6]) ?>

    <!--<div class="form-group">
        <?= $form->field($model, 'mission_id')->dropdownList(
            ArrayHelper::map(Missions::find()->all(), 'id', 'title'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Mission')]
        ) ?>
   </div>-->
   
        <?= $form->field($model, 'evokation_category_id')->dropdownList(
            ArrayHelper::map(EvokationCategories::find()->all(), 'id', 'title'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Category')]
        ) ?>
   
        <?= $form->field($model, 'difficulty_level_id')->dropdownList(
            ArrayHelper::map(DifficultyLevels::find()->all(), 'id', 'title'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Difficulty Level')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MissionsModule.base', 'Create') : Yii::t('MissionsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>