<?php

use humhub\compat\CActiveForm;

?>

<div class="content_edit" id="evokation_edit_<?php echo $evokation->id; ?>">

    <?php
    $form = CActiveForm::begin(['id' => 'evokation-edit-form_' . $evokation->id]);
    echo $form->label($evokation, "title", ['class' => 'control-label']);
    ?>

    <?php echo $form->textArea($evokation, 'title', array('class' => 'form-control', 'id' => 'evokation_input_title_' . $evokation->id, 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', 'Edit your evokation title...'))); ?>

    <?php
    echo $form->label($evokation, "content", ['class' => 'control-label']);
    ?>

    <?php echo $form->textArea($evokation, 'description', array('class' => 'form-control', 'id' => 'evokation_input_text_' . $evokation->id, 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', 'Edit your evokation content...'))); ?>    

    <?= $form->label($evokation, "youtube_url", ['class' => 'control-label']); ?>
    <?= $form->textArea($evokation, 'youtube_url', array('class' => 'form-control', 'id' => 'evokation_input_text_' . $evokation->id, 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', 'Edit your evokation content...'))); ?>    

<script type="text/javascript">
    
    var editevokationResultHandler = function(json) {
        $("#evokationform-loader_<?= $evokation->id ?>").addClass("hidden");
        var $entry = $(".wall_<?= $evokation->getUniqueId() ?>");
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
    
    var editevokationBeforeSendHandler = function() {
        $(".wall_<?= $evokation->getUniqueId() ?>").find('.errorMessage').empty().hide();
        $("#evokationform-loader_<?= $evokation->id ?>").removeClass("hidden");
    };
    
</script>
    <div class="content_edit">
        <hr />
        <?php if(version_compare(Yii::$app->version, '1.0.0-beta.1', 'gt')) : ?>
        <?php echo \humhub\widgets\LoaderWidget::widget(["id" => 'evokationform-loader_'.$evokation->id, 'cssClass' => 'loader-postform hidden']); ?>
        <?php endif; ?>
            <?php
        echo \humhub\widgets\AjaxButton::widget([
            'label' => 'Save',
            'ajaxOptions' => [
                'dataType' => 'json',
                'type' => 'POST',
                'beforeSend' => 'editevokationBeforeSendHandler',
                'success' => 'editevokationResultHandler',
                'url' => $evokation->content->container->createUrl('/missions/evokation/edit', ['id' => $evokation->id]),
            ],
            'htmlOptions' => [
                'class' => 'btn btn-primary btn-comment-submit',
                'id' => 'evokation_edit_post_' . $evokation->id,
                'type' => 'submit'
            ]
        ]);
        echo '&nbsp;';
        echo \humhub\widgets\AjaxButton::widget([
            'label' => 'Cancel',
            'ajaxOptions' => [
                'type' => 'POST',
                'success' => new yii\web\JsExpression('function(html){ $(".wall_' . $evokation->getUniqueId() . '").replaceWith(html); }'),
                'url' => $evokation->content->container->createUrl('/missions/evokation/reload', ['id' => $evokation->id]),
            ],
            'htmlOptions' => [
                'class' => 'btn btn-danger btn-comment-submit',
                'id' => 'evokation_edit_cancel_post_' . $evokation->id
            ]
        ]);
        ?>
        <br />
    </div>
    <?php CActiveForm::end(); ?>
</div>    