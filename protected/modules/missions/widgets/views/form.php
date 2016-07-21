<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$firstPrimary = true;
$firstSecondary = true;

?>

    <h3 style = "margin-bottom:30px"><?= Yii::t('MissionsModule.base', 'Activity: {activity}', array('activity' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title)) ?></h3>
    <p style = "margin-bottom:20px"><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description ?></p>
    <p style = "margin-bottom:20px"><?= Yii::t('MissionsModule.widgets_views_evidenceForm', "<strong>Rubric:</strong> {rubric}", array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></p>
    
    <div class="row" style = "margin-bottom:40px">
        <div class="col-xs-4">
            <h6><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6>
            
            <?php
                foreach($activity->getPrimaryPowers() as $power):
                    if($firstPrimary)
                        $firstPrimary = false;
            ?>           
            
            <p><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $power->getPower()->title, 'points' => $power->value)); ?></p>
            
            <?php endforeach; ?>
            
        </div>
        <div class="col-xs-8">
            <h6><?= Yii::t('MissionsModule.base', 'Secondary Power') ?></h6>
            
            <?php
                foreach($activity->getSecondaryPowers() as $power):
                    if($firstSecondary)
                        $firstSecondary = false;
            ?>           
            
            <p><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $power->getPower()->title, 'points' => $power->value)); ?></p>
            
            <?php endforeach; ?>
            
        </div>
    </div>
                        
    <h4 style = "margin-bottom:20px"><?= Yii::t('MissionsModule.base', 'Create an Evidence for this Activity:') ?></h4>
    
    <?php
    
        echo Html::hiddenInput('activityId', $activity->id);
        echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Page Title"))); 
        echo Html::textArea("text", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '10', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Content")));

    ?>

<style type="text/css">

.text-margin{
    margin-top: 5px;
}
</style>
    

