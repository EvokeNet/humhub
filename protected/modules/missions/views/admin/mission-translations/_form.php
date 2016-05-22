<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\languages\models\Languages;


/* @var $this yii\web\View */
/* @var $model app\modules\missions\models\MissionTranslations */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mission-translations-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'mission_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php //$form->field($model, 'language_id')->textInput() ?>
    
    <?= $form->field($model, 'language_id')->dropdownList(
            ArrayHelper::map(Languages::find()->all(), 'id', 'language'),
            ['prompt' => Yii::t('MissionsModule.base', 'Select Language')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('MissionsModule.base', 'Create') : Yii::t('MissionsModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
