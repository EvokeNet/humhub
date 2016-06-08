<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$firstPrimary = true;
$firstSecondary = true;

?>

<?php
    echo Html::tag('h3', Html::encode(isset($activity->activityTranslations[0]) ? Yii::t('MissionsModule.base', 'Activity:').' '.$activity->activityTranslations[0]->title : Yii::t('MissionsModule.base', 'Activity:').' '.$activity->title), ['class' => 'font-weight-bold']);
    echo Html::tag('p', Html::encode(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description), ['class' => 'description']);
    echo Html::tag('hr');

    foreach($activity->getPrimaryPowers() as $power){
        if($firstPrimary){
            echo Html::tag('b', Yii::t('MissionsModule.widgets_views_evidenceForm', "Primary power:")." ");
            $firstPrimary = false;
        }
        echo Html::tag('br');
        echo $power->getPower()->title." - ";
        echo $power->value." ";
        echo Yii::t('MissionsModule.widgets_views_evidenceForm', "points");
    }

    echo Html::tag('br');
    echo Html::tag('hr');

    foreach($activity->getSecondaryPowers() as $power){
        if($firstSecondary){
            echo Html::tag('b', Yii::t('MissionsModule.widgets_views_evidenceForm', "Secondary power:")." ");
            $firstSecondary = false;
        }
        echo Html::tag('br');
        echo $power->getPower()->title." - ";
        echo $power->value." ";
        echo Yii::t('MissionsModule.widgets_views_evidenceForm', "points");
    }

    echo Html::tag('br');
     
    echo Html::tag('h4', Html::encode(Yii::t('MissionsModule.base', 'Create an Evidence for this Activity:')), ['class' => 'font-weight-bold']);
    echo Html::hiddenInput('activityId', $activity->id);
    echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Page Title"))); 

    echo Html::textArea("text", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '10', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Content")));

?>

<style type="text/css">

.text-margin{
    margin-top: 5px;
}

</style>
    

