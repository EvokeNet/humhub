<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>
<div id="evokation_form">
<?php

    echo Html::tag('h4', Html::encode(Yii::t('MissionsModule.widgets_views_evokationForm', 'Elevator Pitch')), ['class' => 'font-weight-bold']);
    echo Html::tag('br');
    // echo Html::hiddenInput('missionId', $mission->id);    
    echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "Title"))); 
    echo Html::textArea("youtube_url", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '1', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "YouTube URL")));
    echo Html::textArea("description", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '10', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "Description")));

?>
</div>

<!-- REMOVE FILE UPLOAD -->
<script>
	$( document ).ready(function() {
	    $('.fileinput-button').remove();
	    $('.fa.fa-cogs').remove();


    var oldHandleResponse = handleResponse;

        handleResponse = function(response) {
          oldHandleResponse(response);
          if (!response.errors) {
                $('#evokation_form').parent().parent().remove();
                window.location.hash = "";
                window.location.hash = "wallEntry_" + response.wallEntryId;
                reLoadPopUps();
          }
        }

    });


</script>    

