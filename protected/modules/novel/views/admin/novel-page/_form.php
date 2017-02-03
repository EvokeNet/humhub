<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\languages\models\Languages;
use app\modules\novel\models\Chapter;

/* @var $this yii\web\View */
/* @var $model app\modules\novel\models\NovelPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="novel-page-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'page_image')->fileInput() ?>

    <?php if(!empty($model->page_image)): ?>

        <div class = "well">
            <label><?php $file = explode('uploads/', $model->page_image); echo Yii::t('NovelModule.base', 'Uploaded Image: {file}', array('file' => $file[0])); ?></label>
            <br><a href = "<?= $model->page_image ?>" target = "_blank"><img src = "<?= $model->page_image ?>" width = "200"></img></a>
        </div><br><br>

    <?php else: ?>

        <div class = "well">
            <span><?= Yii::t('NovelModule.base', 'No images uploaded yet') ?></span>
        </div><br>

    <?php endif; ?>

    <?= $form->field($model, 'page_number')->input('number') ?>

    <?= $form->field($model, 'language_id')->dropdownList(
            ArrayHelper::map(Languages::find()->all(), 'id', 'language'),
            ['prompt' => Yii::t('NovelModule.base', 'Select Language')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('NovelModule.base', 'Create') : Yii::t('NovelModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
