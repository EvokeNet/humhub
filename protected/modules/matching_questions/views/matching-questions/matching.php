<?php

use humhub\compat\CActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\modules\matching_questions\models\MatchingQuestions;


?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 style = "text-align:center; line-height:40px; padding: 10px 30px">
                    <?php// Yii::t('MatchingModule.base', 'Congratulations! You have ventured further than most by answering this call.
                    //Now, it is time to find out what type of Evoke agent are you. What do you know?
                    //What are the strengths, passions, and abilities you will bring to the Evoke network?
                    //Answer the following and find out what type of Super Hero is hiding inside you!') ?>
                    <?= Yii::t('MatchingModule.base', 'By discovering your natural powers, you can learn how to fit into the Evoke network. Try to imagine vividly what would you do in each of the scenarios described and honestly answer each question.') ?>  
                    <?php if(Yii::$app->session->getFlash('matching_questions_incomplete_answers')): ?>
                        <br><span id="warning" class="warning"><?= Yii::t('MatchingModule.base', 'In case of redirect, please make sure to answer all questions') ?></span>
                    <?php endif; ?>
                </h3>
            </div>
            <div class="panel-body">

                <div class="questionnaire">
                    
                <?php
                    $form = CActiveForm::begin([
                        'id' => 'questionnaire',
                    ]);
                ?>              

                <?php foreach($questions as $question): ?>
                
                    <h5 style = "line-height:30px; border-left: 3px solid #28C503; padding: 0 20px"><?= isset($question->matchingQuestionTranslations[0]) ? $question->matchingQuestionTranslations[0]->description : $question->description ?></h5>
                    
                    <br>
                    
                    <div class="form">

                        <?php foreach($question->matchingAnswers as $answer):  ?>
                            <?php $maxValue = count($question->matchingAnswers); ?>
                            <!-- MULTIPLE CHOICE -->
                            <?php if($maxValue > 2) :  ?>
                                <label style = "font-size:12pt">
                                    <input type="number" min="1" max=<?= $maxValue ?> name="matching_answer_<?= $answer->id ?>_matching_question_<?= $question->id ?>" value = "" >
                                        <?= isset($answer->matchingAnswerTranslations[0]) ? $answer->matchingAnswerTranslations[0]->description : $answer->description ?>
                                </label>   <br>
                            <!-- SINGLE CHOICE -->     
                            <?php else: ?>    
                                <label style = "margin-right:20px; font-size:12pt">
                                    <input type="radio" name="matching_question_<?= $question->id ?>" value = <?= $answer->id ?> >
                                        <?= isset($answer->matchingAnswerTranslations[0]) ? $answer->matchingAnswerTranslations[0]->description : $answer->description ?>
                                </label>
                            <?php endif; ?>
                            
                        <?php endforeach; ?>    
                    </div>

                    <div class = "text-center"><div class = "blue-border"></div></div>
                <?php endforeach; ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('MatchingModule.base', "Submit"), ['class' => 'btn btn-cta1']) ?>
                </div>

                <?php
                    CActiveForm::end(); 
                ?>
                </div>

            </div>
        </div>
    </div>
</div>

<style type="text/css">

.intro{
    /*margin-left: 20px;*/
    font-size: 22px;
    text-align: center;
    /*margin: auto;*/
    /*width: 75%;*/
    padding-top:20px;
}

.warning{
    padding-top: 10px;
    color: red!important;
    font-size: 12px!important;
}

form{
    margin-left: 20px;
}
.question{
    font-size: 20pt;
}

.questionnaire{
    margin: auto;
    /*width: 75%;*/
    /*padding-top: 30px;*/
    padding: 20px 50px 0px;
}

</style>


<script type="text/javascript">


    function warningMessage(warning){
        alert(warning);
    }

    function validateQuestionnaire(){
        var form = document.getElementById('questionnaire');
        var forms = form.getElementsByClassName('form');

        //for each question
        for(var i=0; i < forms.length ;i++){
            var labels = forms[i].getElementsByTagName('label');
            var order = [];
            var checked = false;
            var singleChoice = false;

            for(var j=0;j < labels.length;j++){
                var inputs = labels[j].getElementsByTagName('input');

                //for each input
                for(x=0; x < inputs.length ; x++){
                    var inputName = inputs[x].getAttribute("name");
                    var inputValue = inputs[x].value;

                    if(inputName.startsWith("matching_question")){
                    //SINGLE CHOICE
                        singleChoice = true;

                        if (checked == false){ 
                            checked = inputs[x].checked 
                        }

                    }else{

                    // ORDER QUESTION
                        if(inputValue >= 1 && inputValue <= 4){

                            if($.inArray(inputValue, order) >= 0){
                                warningMessage("<?= Yii::t('MatchingModule.base', 'Order questions from 1 to 4. Do not repeat numbers.') ?>");
                                return false;
                            }
                            order.push(inputValue);

                        }else{
                            warningMessage("<?= Yii::t('MatchingModule.base', 'Answer all the order questions from 1 to 4.') ?>");
                            return false;
                        }
                    }

                }
                
            }

            if(singleChoice && !checked){
                warningMessage("<?= Yii::t('MatchingModule.base', 'Choose one answer for each single-choice question.') ?>");
                return false;
            }
            
        };

        return true;

    }

    jQuery(document).ready(function () {
        $('#questionnaire').submit(
            function(){
                return validateQuestionnaire();
            }
        );
    });


</script>