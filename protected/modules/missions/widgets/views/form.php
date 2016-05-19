<?php

use yii\helpers\Html;
?>
<?php 
    
    echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Page Title"))); 

/* Modify textarea for mention input */
echo \humhub\widgets\RichTextEditor::widget(array(
    'id' => 'contentForm_question',
));
?>

<div class="contentForm_options">
    
    <?php echo Html::textArea("text", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '10', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Content"))); ?>

</div>
