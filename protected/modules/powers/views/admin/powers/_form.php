<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\powers\models\Powers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="powers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'improve_multiplier') ?>

    <?= $form->field($model, 'improve_offset') ?>
    
    <?php //echo $form->field($model, 'image')->fileInput(['id' => 'logo', 'style' => 'display: none']); ?>

    <!--<div class="well">
        <div class="image-upload-container" id="logo-upload">

            <img class="img-rounded" id="logo-image"
                    src="<?php
                    // if (!empty($model->image)) {
                    //     echo $model->image;
                    // }
                    ?>"
                    data-src="holder.js/140x140"
                    alt="<?php //echo Yii::t('AdminModule.views_setting_index', "You're using no logo at the moment. Upload your logo now."); ?>"
                    style="max-height: 40px;"/>

            <div class="image-upload-buttons" id="logo-upload-buttons" style="display: block;">
                <a href="#" onclick="javascript:$('#logo').click();" class="btn btn-info btn-sm"><i
                        class="fa fa-cloud-upload"></i></a>

                <?php
                // echo \humhub\widgets\ModalConfirm::widget(array(
                //     'uniqueID' => 'modal_logoimagedelete',
                //     'linkOutput' => 'a',
                //     'title' => Yii::t('AdminModule.views_setting_index', '<strong>Confirm</strong> image deleting'),
                //     'message' => Yii::t('UserModule.views_setting_index', 'Do you really want to delete your logo image?'),
                //     'buttonTrue' => Yii::t('AdminModule.views_setting_index', 'Delete'),
                //     'buttonFalse' => Yii::t('AdminModule.views_setting_index', 'Cancel'),
                //     'linkContent' => '<i class="fa fa-times"></i>',
                //     'cssClass' => 'btn btn-danger btn-sm',
                //     'style' => !empty($model->image) ? '' : 'display: none;',
                //     'linkHref' => Url::toRoute("/admin/setting/delete-logo-image"),
                //     'confirmJS' => 'function(jsonResp) { resetLogoImage(jsonResp); }'
                // ));
                ?>
            </div>
        </div>
    </div>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('PowersModule.base', 'Create') : Yii::t('PowersModule.base', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
