<?php

use humhub\compat\CActiveForm;
use yii\helpers\Html;
use app\modules\matching_questions\models\MatchingQuestions;

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


<style type="text/css">

form{
    margin-left: 20px;
}
.question{
    font-size: 18px;
}

</style>
