<?php

use humhub\compat\CActiveForm;
use yii\helpers\Html;
use app\modules\matching_questions\models\MatchingQuestions;


?>


    <div class="intro">
        Congratulations, you have ventured further than most by answering this call. 
        <BR>Now, it's time to find out what type of Evoke agent are you? What do you know? 
        <BR>What are the strengths, passions, and abilities you will bring to the Evoke network? 
        <BR>Answer the following and find out what type of Super Hero is hiding inside you!
    </div>

<div class="questionnaire">
<?php
    $form = CActiveForm::begin();
?>              

<?php 

foreach($questions as $question):
    echo "<p class='question'>".$question->description."</p><BR>";
    ?>

        <div class="form">

            <?php foreach($question->matchingAnswers as $answer):  ?>
                <?php $maxValue = count($question->matchingAnswers); ?>
                <!-- MULTIPLE CHOICE -->
                <?php if($maxValue > 2) :  ?>
                    <label>
                        <input type="number" min="1" max=<?= $maxValue ?> name="matching_answer_<?= $answer->id ?>_matching_question_<?= $question->id ?>" value = "" >
                            <?= $answer->description ?>
                    </label>   
                <!-- SINGLE CHOICE -->     
                <?php else: ?>    
                    <label>
                        <input type="radio" name="matching_question_<?= $question->id ?>" value = <?= $answer->id ?> >
                            <?= $answer->description ?>
                    </label>
                <?php endif; ?>
                
                <BR>
            <?php endforeach; ?>    
        </div>
        <HR>
    <?php

endforeach;

?>

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