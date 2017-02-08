<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\novel\models\NovelPage;

?>

<div class="chapter-pages-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'novel_id')->dropdownList(
            ArrayHelper::map(NovelPage::find()->all(), 'id', 'id'),
            ['prompt' => Yii::t('NovelModule.base', 'Select Page')]
        ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('NovelModule.base', 'Add') : Yii::t('NovelModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
