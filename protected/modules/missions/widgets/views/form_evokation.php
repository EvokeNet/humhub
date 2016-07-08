<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

    echo Html::tag('h4', Html::encode(Yii::t('MissionsModule.base', 'Submit Your Evokation')), ['class' => 'font-weight-bold']);
    echo Html::tag('br');
    //echo Html::hiddenInput('activityId', $activity->id);
    echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "Title"))); 
    echo Html::textArea("description", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '10', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "Description")));
    echo Html::textArea("youtube_url", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '1', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "YouTube URL")));
    echo Html::textArea("gdrive_url", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '1', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evokationForm', "Google Drive File URL")));

?>

<style type="text/css">

.text-margin{
    margin-top: 5px;
}
</style>
    

