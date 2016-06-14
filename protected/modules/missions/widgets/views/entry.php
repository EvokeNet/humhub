<?php

use yii\helpers\Html;

echo Html::beginForm(); 
$activity = $evidence->getActivities();
?>

<div id="error-message" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 id="error-message-title" class="modal-title">
            Error
        </h4>
      </div>
      <div id="error-message-content" class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            Close
        </button>
      </div>
    </div>

  </div>
</div>

<strong>
   <?php print humhub\widgets\RichText::widget(['text' => $evidence->title]); ?>
</strong>
<br>
<?php print humhub\widgets\RichText::widget(['text' => $evidence->text]);?>

<br><br>

<div class="clearFloats"></div>

<hr>
<div class="activity_area">
	<?= isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title ?>
	<br>
	<?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?>
</div>

<?php echo Html::endForm(); ?>

<BR>
<div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" href="#collapseEvidence<?= $evidence->id ?>">
        	Review
        </a>
      </h4>
    </div>

    <div id="collapseEvidence<?= $evidence->id ?>" class="panel-collapse collapse">
    	<h2>Distribute points for Curiosity</h2>
    	<p>
    		Here is  the question that confirms whether or not the evidence is sufficient.
    		Here is  the question that confirms whether or not the evidence is sufficient.
    		Here is  the question that confirms whether or not the evidence is sufficient.
    	</p>
    	<form id = "review<?= $evidence->id ?>" class="review">
    		<div class="radio">
  				<label>
  					<input type="radio" name="yes-no-opt<?= $evidence->id ?>" class="btn-show<?= $evidence->id ?>" value="yes">
  					Yes
  				</label>
  				<div id="yes-opt<?= $evidence->id ?>" class="collapse">
  					<?php for ($x=1; $x <= 5; $x++): ?> 
  					<label class="radio-inline">
  						<input type="radio" name="grade<?= $evidence->id ?>" value="<?= $x?>">
  						<?php echo $x; ?>
  					</label>
  					<?php endfor; ?>
  					<p>
  						How many points will you award this evidence?
  					</p>
  				</div>
			  </div>
			  <div class="radio">
				  <label>
					 <input type="radio" name="yes-no-opt<?= $evidence->id ?>" class="btn-hide<?= $evidence->id ?>" value="no">
					 No
				  </label>
			  </div>
			  <br>
			  <br>
			  For every piece of evidence you review, you receive 10 points.
			  <br>

			  <button type="submit" id="post_submit_review" class="btn btn-info">
				  Submit Review
			  </button>
    	</form>
    </div>
  </div>
</div>


<style type="text/css">

.activity_area{
	font-size: 12px;
}

</style>

<script>

function message(title, message){
	document.getElementById("error-message-content").innerHTML = message;
	document.getElementById("error-message-title").innerHTML = title;
  $("#error-message").modal("show");
}

function review(id, opt, grade){
    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              document.getElementById("error-message-content").innerHTML = xhttp.responseText;
              $("#error-message").modal("show");
            }
        }
    };
    xhttp.open("GET", "<?= $contentContainer->createUrl('/missions/evidence/review'); ?>&opt="+opt+"&grade="+grade+"&evidenceId="+id , true);
    xhttp.send();

    return false;
}

function validateReview<?= $evidence->id ?>(id){

	var opt = document.querySelector('input[name="yes-no-opt'+id+'"]:checked');
	var grade = document.querySelector('input[name="grade'+id+'"]:checked');
	opt = opt? opt.value : null;
	grade = grade? grade.value : null;

	if(opt == "yes"){

		if(grade >= 1){
			return review(id, opt, grade);
		}

		message("Error", "Choose how many points you will award this evidence.");
		
	}else if(opt == "no"){
		return review(id, opt);
	}else{
    message("Error", "Please, Answer yes or no.");
  }

	return false;
}

jQuery(document).ready(function () {
        $('#review<?= $evidence->id ?>').submit(
            function(){
                return validateReview<?= $evidence->id ?>(<?= $evidence->id ?>);
            }
        );
    });


$(document).ready(function(){
    $(".btn-hide<?= $evidence->id ?>").click(function(){
        $("#yes-opt<?= $evidence->id ?>").collapse('hide');
    });
    $(".btn-show<?= $evidence->id ?>").click(function(){
        $("#yes-opt<?= $evidence->id ?>").collapse('show');
    });
});
</script>