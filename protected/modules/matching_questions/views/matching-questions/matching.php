<?php

use humhub\compat\CActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\modules\matching_questions\models\MatchingQuestions;


?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-9 col-md-auto">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="matching-header">
                        <?php// Yii::t('MatchingModule.base', 'Congratulations! You have ventured further than most by answering this call.
                        //Now, it is time to find out what type of Evoke agent are you. What do you know?
                        //What are the strengths, passions, and abilities you will bring to the Evoke network?
                        //Answer the following and find out what type of Super Hero is hiding inside you!') ?>
                        
                        <?= Yii::t('MatchingModule.base', 'Discover your powers. Imagine what you would do in each of the following scenarios. Answer honestly and discover your true potential.') ?>  

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

                        <h5 class="question-description"><?= isset($question->matchingQuestionTranslations[0]) ? $question->matchingQuestionTranslations[0]->description : $question->description ?></h5>

                        <br>

                        <div class="form">

                            <?php foreach($question->matchingAnswers as $answer):  ?>
                                <?php $maxValue = count($question->matchingAnswers); ?>
                                <!-- MULTIPLE CHOICE -->
                                <?php if($maxValue > 2) :  ?>
                                    <label class="multiple-choice-answer">
                                        <input type="text" pattern="[1-<?= $maxValue ?>]*" class= "number_input" min="1" max=<?= $maxValue ?> name="matching_answer_<?= $answer->id ?>_matching_question_<?= $question->id ?>" value = "" >
                                            <?= isset($answer->matchingAnswerTranslations[0]) ? $answer->matchingAnswerTranslations[0]->description : $answer->description ?>
                                    </label>   <br>
                                <!-- SINGLE CHOICE -->
                                <?php else: ?>
                                    <label>
                                        <input type="radio" name="matching_question_<?= $question->id ?>" value = <?= $answer->id ?> >
                                            <?= isset($answer->matchingAnswerTranslations[0]) ? $answer->matchingAnswerTranslations[0]->description : $answer->description ?>
                                    </label><br />
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
</div>

<style type="text/css">

form{
    margin-left: 20px;
}

.topbar, .footer {
  display: none;
}

body {
  padding-top: 1em;
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
                            warningMessage("<?= Yii::t('MatchingModule.base', 'Answer all the questions before submitting.') ?>");
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
