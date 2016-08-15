<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$firstPrimary = true;
$firstSecondary = true;

?>

<div id="evidence_form">
<div class="panel panel-default">
    <div class="panel-body panel-body grey-box">

        <h4><span class = "activity-number"><?= $activity->position ?></span><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?></h4>
        <br />
        <p class="description">
            <?php echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?>
        </p>
        <br />
        <p class="description"><?= Yii::t('MissionsModule.widgets_views_evidenceForm', "<strong>Rubric:</strong> {rubric}", array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></p>

        <div class="row" style = "margin-top:20px">
            <div class="col-xs-5 text-center">
                <h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6>

                <?php
                    foreach($activity->getPrimaryPowers() as $power):
                        if($firstPrimary)
                            $firstPrimary = false;

                        $name = $power->getPower()->title;

                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                            $name = $power->getPower()->powerTranslations[0]->title;
                ?>

                <img src = "<?php echo $power->getPower()->image; ?>" width=70px style = "margin-bottom:10px">
                <p><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></p>
                <br />

                <?php endforeach; ?>

           </div>
            <div class="col-xs-7 text-center">
                <h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6>

                <?php
                    foreach($activity->getSecondaryPowers() as $power):
                        if($firstSecondary)
                            $firstSecondary = false;

                        $name = $power->getPower()->title;

                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                            $name = $power->getPower()->powerTranslations[0]->title;
                ?>

                <img src = "<?php echo $power->getPower()->image; ?>" width=70px style = "margin-bottom:15px">
                <p><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></p>
                <br />
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>

    <h4 style = "margin-bottom:20px"><?= Yii::t('MissionsModule.base', 'Create an Evidence for this Activity:') ?></h4>

    <?php

        echo Html::hiddenInput('activityId', $activity->id);
        echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Page Title")));
        echo Html::textArea("text", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '10', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Content")));

    ?>
</div>

<script type="text/javascript">

$( document ).ready(function() {
   var oldHandleResponse = handleResponse;

    handleResponse = function(response) {
      oldHandleResponse(response);
      if (!response.errors) {
            $('#evidence_form').parent().parent().remove();
            window.location.hash = "";
            window.location.hash = "wallEntry_" + response.wallEntryId;
      }
    }

});



</script>

<style type="text/css">

.text-margin{
    margin-top: 5px;
}
</style>
