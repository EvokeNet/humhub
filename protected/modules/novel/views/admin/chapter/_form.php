<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\languages\models\Languages;
use app\modules\missions\models\Missions;

/* @var $this yii\web\View */
/* @var $model app\modules\novel\models\NovelPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="novel-page-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'number')->input('number') ?>

    <?= $form->field($model, 'mission_id')->dropdownList(
            ArrayHelper::map(Missions::find()->all(), 'id', 'title'),
            ['prompt' => Yii::t('NovelModule.base', 'Select Mission')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('NovelModule.base', 'Create') : Yii::t('NovelModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
