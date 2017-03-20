function handleResponse(response) {
        if (!response.errors) {
            // application.modules_core.wall function
            currentStream.prependEntry(response.wallEntryId);

            // Reset Form (Empty State)
            jQuery('.contentForm_options').hide();
            $('.contentForm').filter(':text').val('');
            $('.contentForm').filter('textarea').val('').trigger('autosize.resize');
            $('.contentForm').attr('checked', false);
            $('.userInput').remove(); // used by UserPickerWidget
            $('#notifyUserContainer').addClass('hidden');
            $('#notifyUserInput').val('');
            
            setDefaultVisibility();
            
            $('#contentFrom_files').val('');
            $('#public').attr('checked', false);
            $('#contentForm_message_contenteditable').html('<?php echo Html::encode(Yii::t("ContentModule.widgets_views_contentForm", "What\'s on your mind?")); ?>');
            $('#contentForm_message_contenteditable').addClass('atwho-placeholder');
            
            $('#contentFormBody').find('.atwho-input').trigger('clear');
            
            // Notify FileUploadButtonWidget to clear (by providing uploaderId)
            resetUploader('contentFormFiles');
        } else {
            $('#contentFormError').show();
            $.each(response.errors, function (fieldName, errorMessage) {
                // Mark Fields as Error
                fieldId = 'contentForm_' + fieldName;
                $('#' + fieldId).addClass('error');
                $.each(errorMessage, function (key, msg) {
                    $('#contentFormError').append('<li><i class=\"icon-warning-sign\"></i> ' + msg + '</li>');
                });
            });
        }
        $('.contentForm_options .btn').show();
        $('#postform-loader').addClass('hidden');
}