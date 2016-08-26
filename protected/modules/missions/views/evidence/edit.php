<?php

use humhub\compat\CActiveForm;

?>

<div class="content_edit" id="evidence_edit_<?php echo $evidence->id; ?>">

    <?php
    $form = CActiveForm::begin(['id' => 'evidence-edit-form_' . $evidence->id]);
    echo $form->label($evidence, "title", ['class' => 'control-label']);
    ?>

    <?php echo $form->textArea($evidence, 'title', array('class' => 'form-control', 'id' => 'evidence_input_title_' . $evidence->id, 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', 'Edit your Evidence title...'))); ?>

    <?php
    echo $form->label($evidence, "content", ['class' => 'control-label']);
    ?>

    <?php echo $form->textArea($evidence, 'text', array('class' => 'form-control', 'id' => 'evidence_input_text_' . $evidence->id, 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', 'Edit your Evidence content...'))); ?>    


    <?php
    // Creates Uploading Button
    echo humhub\modules\file\widgets\FileUploadButton::widget(array(
        'uploaderId' => 'post_upload_' . $evidence->id,
        'object' => $evidence
    ));
    ?>

    <div class="content_edit">
        <hr />
        <?php if(version_compare(Yii::$app->version, '1.0.0-beta.1', 'gt')) : ?>
        <?php echo \humhub\widgets\LoaderWidget::widget(["id" => 'evidenceform-loader_'.$evidence->id, 'cssClass' => 'loader-postform hidden']); ?>
        <?php endif; ?>
            <?php
        echo \humhub\widgets\AjaxButton::widget([
            'label' => 'Save',
            'ajaxOptions' => [
                'dataType' => 'json',
                'type' => 'POST',
                'beforeSend' => 'editEvidenceBeforeSendHandler',
                'success' => 'editEvidenceResultHandler',
                'url' => $evidence->content->container->createUrl('/missions/evidence/edit', ['id' => $evidence->id]),
            ],
            'htmlOptions' => [
                'class' => 'btn btn-primary btn-comment-submit',
                'id' => 'evidence_edit_post_' . $evidence->id,
                'type' => 'submit'
            ]
        ]);
        echo '&nbsp;';
        echo \humhub\widgets\AjaxButton::widget([
            'label' => 'Cancel',
            'ajaxOptions' => [
                'type' => 'POST',
                'success' => new yii\web\JsExpression('function(html){ $(".wall_' . $evidence->getUniqueId() . '").replaceWith(html); }'),
                'url' => $evidence->content->container->createUrl('/missions/evidence/reload', ['id' => $evidence->id]),
            ],
            'htmlOptions' => [
                'class' => 'btn btn-danger btn-comment-submit',
                'id' => 'evidence_edit_cancel_post_' . $evidence->id
            ]
        ]);
        ?>
        <br />
    </div>

    <?php
        // Creates a list of already uploaded Files
        echo \humhub\modules\file\widgets\FileUploadList::widget(array(
            'uploaderId' => 'post_upload_' . $evidence->id,
            'object' => $evidence
        ));
        ?>



    <?php CActiveForm::end(); ?>
</div>    



<script type="text/javascript">
    
    var editEvidenceResultHandler = function(json) {
        $("#evidenceform-loader_<?= $evidence->id ?>").addClass("hidden");
        var $entry = $(".wall_<?= $evidence->getUniqueId() ?>");
        if(json.success) {
            $entry.replaceWith(json.output);
        } else if(json.errors) {
            var $errorMessage = $entry.find('.errorMessage');
            var errors = '';
            $.each(json.errors, function(key, value) {
                errors += value +'<br />';
            });
            $errorMessage.html(errors).show();
        }
    };
    
    var editEvidenceBeforeSendHandler = function() {
        $(".wall_<?= $evidence->getUniqueId() ?>").find('.errorMessage').empty().hide();
        $("#evidenceform-loader_<?= $evidence->id ?>").removeClass("hidden");
    };
    
</script>