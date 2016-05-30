<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<?php
    echo Html::tag('h3', Html::encode(isset($activity->activityTranslations[0]) ? Yii::t('MissionsModule.base', 'Activity:').' '.$activity->activityTranslations[0]->title : Yii::t('MissionsModule.base', 'Activity:').' '.$activity->title), ['class' => 'font-weight-bold']);
    echo Html::tag('p', Html::encode(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description), ['class' => 'description']);
    foreach($activity->getActivityPowers() as $power){
    	echo "<p>";
    	if($power->flag){
    		echo Yii::t('MissionsModule.widgets_views_evidenceForm', "Primary power:")." ";
    	}else{
    		echo Yii::t('MissionsModule.widgets_views_evidenceForm', "Secondary power:")." ";
    	}
    	echo $power->getPower()->title." - ";
    	echo $power->value." ";
    	echo Yii::t('MissionsModule.widgets_views_evidenceForm', "points");
    	echo "</p>";
    }
    echo Html::tag('br');
     
    echo Html::tag('h4', Html::encode(Yii::t('MissionsModule.base', 'Create an Evidence for this Activity:')), ['class' => 'font-weight-bold']);
    echo Html::hiddenInput('activityId', $activity->id);
    echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Page Title"))); 

/* Modify textarea for mention input */
echo \humhub\widgets\RichTextEditor::widget(array(
    'id' => 'contentForm_question',
));
?>

<div class="contentForm_options">
    
    <?php echo Html::textArea("text", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '10', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Content"))); ?>

</div>
