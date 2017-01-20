<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$firstPrimary = true;
$firstSecondary = true;

?>

<div id="evidence_form">
<div class="panel panel-default">
    <div class="panel-body panel-body grey-box">

        <h4><span class = "activity2-number"><?= $activity->position ?></span><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?></h4>
        <br />
        <p class="description">
            <?php echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?>
        </p>
        <br />

        <div class="row" style="margin-bottom:20px">
            <div class="col-xs-4"><h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6></div>
            <div class="col-xs-8">

                <?php
                    foreach($activity->getPrimaryPowers() as $power):
                        if($firstPrimary)
                            $firstPrimary = false;

                        $name = $power->getPower()->title;

                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                            $name = $power->getPower()->powerTranslations[0]->title;
                ?>

                
                    <div style="text-align: center; display:inline-block">
                    <img src = "<?php echo $power->getPower()->image; ?>" width=50px>
                    <span style="font-size:10pt"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></span>
                </div>
                    
                <?php endforeach; ?>

            </div>
        </div>

        <div class="row">
            <div class="col-xs-4"><h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6></div>
            <div class="col-xs-8">

                    <?php
                        foreach($activity->getSecondaryPowers() as $power):
                            if($firstSecondary)
                                $firstSecondary = false;

                            $name = $power->getPower()->title;

                            if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                $name = $power->getPower()->powerTranslations[0]->title;
                    ?>
                        
                    <div style="text-align: center; display:inline-block; margin-bottom:10px">
                        <img src = "<?php echo $power->getPower()->image; ?>" width=50px>
                        <span style="font-size:10pt"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></span>
                    </div>
                    
                <?php endforeach; ?>

            </div>

        </div>

        <br /><br />
        <span style="font-size:12pt"><?= Yii::t('MissionsModule.widgets_views_evidenceForm', "<strong>Rubric:</strong> {rubric}", array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></span>
    </div>    
</div>

    <h4 style = "margin-bottom:20px"><?= Yii::t('MissionsModule.base', 'Create an Evidence for this Activity:') ?></h4>

    <?php

        echo Html::hiddenInput('activityId', $activity->id);
        echo Html::textArea("title", '', array('id' => 'contentForm_question', 'class' => 'form-control autosize contentForm', 'rows' => '1', "tabindex" => "1", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Page Title")));
        echo Html::textArea("text", '', array('id' => 'contentForm_question', 'class' => 'text-margin form-control autosize contentForm', 'rows' => '10', "tabindex" => "2", 'placeholder' => Yii::t('MissionsModule.widgets_views_evidenceForm', "Content"),  'required' => true));

        ?>

        <div id="counter" style="font-weight:bold">
            <span id="current">0</span>
            <span id="minimun">/ 140</span>
        </div>

        <?php

        echo "<br>";

        echo \humhub\widgets\AjaxButton::widget([
            'label' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Save Draft'),
            'ajaxOptions' => [
                'url' => $contentContainer->createUrl('/missions/evidence/draft'),
                'type' => 'POST',
                'dataType' => 'json',
                'beforeSend' => "function() { $('.contentForm').removeClass('error'); $('#contentFormError').hide(); $('#contentFormError').empty(); }",
                'beforeSend' => 'function(){ $("#contentFormError").hide(); $("#contentFormError li").remove(); $(".contentForm_options .btn").hide(); $("#postform-loader").removeClass("hidden"); }',
                'success' => "function(response) { handleResponse(response);}"
            ],
            'htmlOptions' => [
                'id' => "post_draft_button",
                'class' => 'btn btn-primary btn-comment-submit',
                'type' => 'submit'
        ]]);
        

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
      loadPopUps();
    }

});

$('textarea[name=text]#contentForm_question').keyup(function() {

    current = $('#current');
    minimun = $('#minimun');

    //change current
    current.text($('textarea[name=text]#contentForm_question').val().length);

    if(current.text() >= 140){
        current.css('color', '#92CE92')
    }else{
        current.css('color', '#9B0000')
    }

})

</script>
