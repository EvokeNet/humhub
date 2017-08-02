<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$firstPrimary = true;
$firstSecondary = true;

$this->registerJsFile('js/stream.js');

?>

<div id="evidence_form">
    <div class="panel panel-default">
        <div class="panel-body grey-box">

            <h4>
                <span><?= '#'.$activity->position ?></span>&nbsp;
                <span class="mission-title"><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?></span>
            </h4>

            <br />
            <p class="description">
                <?php echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?>
            </p>
            <br />

            <div style="margin:30px 0 20px">

                <h6 style="margin-bottom:15px; font-size:12pt"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6>

                <div style="display: flex; flex-wrap: wrap;">
                <?php
                    foreach($activity->getPrimaryPowers() as $power):
                        if($firstPrimary)
                            $firstPrimary = false;

                        $name = $power->getPower()->title;

                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                            $name = $power->getPower()->powerTranslations[0]->title;
                ?>

                        <div class="power-cards">
                            <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                            <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '+{points} {power}', array('power' => $name, 'points' => $power->value)); ?></p>
                        </div>
                    
                <?php endforeach; ?>
                </div>

                <br />

                <h6 style="margin-bottom:15px; font-size:12pt"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6>
                    <div style="display: flex; flex-wrap: wrap;">
                        <?php
                            foreach($activity->getSecondaryPowers() as $power):
                                if($firstSecondary)
                                    $firstSecondary = false;

                                $name = $power->getPower()->title;

                                if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                    $name = $power->getPower()->powerTranslations[0]->title;
                        ?>

                            
                        <div>
                            <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                            <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></p>
                        </div>
                        
                        
                            <div class="power-cards">
                                <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                                <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '+{points} {power}', array('power' => $name, 'points' => $power->value)); ?></p>
                            </div>
                        
                        
                        <?php endforeach; ?>
                    </div>

        </div>

            <!-- <div class="row">
                <div class="col-xs-4"></div>
                <div class="col-xs-8">

                </div>

            </div> -->

            <span class="mission-title" style="font-size:11pt; margin:30px 0 10px"><?= Yii::t('MissionsModule.widgets_views_evidenceForm', "<strong>Rubric:</strong> {rubric}", array('rubric' => isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->rubric : $activity->rubric)) ?></span>

        </div>    
    </div>

    <div class="panel panel-default">
        <div class="panel-body grey-box">
            <span class="mission-title" style = "margin: 10px 0 20px; font-size: 18pt"><?= Yii::t('MissionsModule.base', 'Create an Evidence for this Activity:') ?></span>
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
                echo "<div style='float:right'>";
                echo \humhub\widgets\AjaxButton::widget([
                    'label' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Save Draft'),
                    'ajaxOptions' => [
                        'url' => $contentContainer->createUrl('/missions/evidence/draft'),
                        'type' => 'POST',
                        'dataType' => 'json',
                        'beforeSend' => "function() { $('.contentForm').removeClass('error'); $('#contentFormError').hide(); $('#contentFormError').empty(); }",
                        'beforeSend' => 'function(){ $("#contentFormError").hide(); $("#contentFormError li").remove(); $(".contentForm_options .btn").hide(); $("#postform-loader").removeClass("hidden"); }',
                        'success' => "function(response) { formHandleResponse(response);}"
                    ],
                    'htmlOptions' => [
                        'id' => "post_draft_button",
                        'class' => 'save_draft_link',
                        'type' => 'submit'
                ]]);
                echo "</div>";
            ?>
        </div>
    </div>

</div>

<script type="text/javascript">

$( document ).ready(function() {

    formHandleResponse = function(response) {
      handleResponse(response);
      if (!response.errors) {
            $('#evidence_form').parent().parent().remove();
            window.location.hash = "";
            window.location.hash = "wallEntry_" + response.wallEntryId;
      }
      loadPopUps();
      updateEvocoins();
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


<style>
.save_draft_link{
    background-color: Transparent;
    background-repeat: no-repeat;
    border: none;
    cursor: pointer;
    overflow: hidden;
    outline: none;
    color: white;
    text-decoration: underline;
    font-size: 14px;
    text-transform: uppercase;
}
</style>
