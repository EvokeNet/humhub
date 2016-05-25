<?php

use humhub\compat\CActiveForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\modules\matching_questions\models\MatchingQuestions;


?>


<div class="intro">
    <?= Yii::t('MatchingModule.base', "Congratulations, you have ventured further than most by answering this call.") ?> 
    <br><?= Yii::t('MatchingModule.base', "Now, it is time to find out what type of Evoke agent are you. What do you know?") ?> 
    <br><?= Yii::t('MatchingModule.base', "What are the strengths, passions, and abilities you will bring to the Evoke network?") ?>
    <br><?= Yii::t('MatchingModule.base', "Answer the following and find out what type of Super Hero is hiding inside you!") ?>
    <p id="warning" class="warning"><?= Yii::t('MatchingModule.base', 'In case of redirect, please make sure to answer all questions') ?></p>
</div>

<div class="questionnaire">
    
<?php
    $form = CActiveForm::begin([
        'id' => 'questionnaire',
    ]);
?>              

<?php foreach($questions as $question): ?>
   
    <p class = "question"><?= isset($question->matchingQuestionTranslations[0]) ? $question->matchingQuestionTranslations[0]->description : $question->description ?></p>
    
    <br>
    
    <div class="form">

        <?php foreach($question->matchingAnswers as $answer):  ?>
            <?php $maxValue = count($question->matchingAnswers); ?>
            <!-- MULTIPLE CHOICE -->
            <?php if($maxValue > 2) :  ?>
                <label>
                    <input type="number" min="1" max=<?= $maxValue ?> name="matching_answer_<?= $answer->id ?>_matching_question_<?= $question->id ?>" value = "" >
                        <?= isset($answer->matchingAnswerTranslations[0]) ? $answer->matchingAnswerTranslations[0]->description : $answer->description ?>
                </label>   
            <!-- SINGLE CHOICE -->     
            <?php else: ?>    
                <label>
                    <input type="radio" name="matching_question_<?= $question->id ?>" value = <?= $answer->id ?> >
                        <?= isset($answer->matchingAnswerTranslations[0]) ? $answer->matchingAnswerTranslations[0]->description : $answer->description ?>
                </label>
            <?php endif; ?>
            
            <BR>
        <?php endforeach; ?>    
    </div>
    <HR>

<?php endforeach; ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php
    CActiveForm::end(); 
?>
</div>


<style type="text/css">

.intro{
    margin-left: 20px;
    font-size: 22px;
    text-align: center;
    margin: auto;
    width: 75%;
}

.warning{
    padding-top: 10px;
    color: red;
    font-size: 12px;
}

form{
    margin-left: 20px;
}
.question{
    font-size: 18px;
}

.questionnaire{
    margin: auto;
    width: 75%;
    padding-top: 30px;
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