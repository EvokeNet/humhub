/* 
********************************************************************************************
MENTOR REVIEW
********************************************************************************************
*/

function draftCurrentTextFormatting(){ 

  $('[id^=current]').each(function() {

    current = $( this );
    if(current.text() >= 140){
        current.css('color', '#92CE92')
    }else{
        current.css('color', '#9B0000')
    }

  });
}


function review(id, comment, opt, grade){
   /* To call this function, it's needed to declare these variables in your view file:
    * - review_action_url - action's url
    */

    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              if(xhttp.responseText == "success"){
                updateReview(id, opt, grade);
              }else{
                $("#review_tab_" + id).replaceWith(xhttp.responseText);
              }
            }
        }
    };
    xhttp.open("GET", review_action_url+"&opt="+opt+"&grade="+grade+"&evidenceId="+id+"&comment="+comment , true);
    xhttp.send();

    return false;
}

function validateReview(id){
  /* To call this function, it's needed to declare these variables in your view file:
    * - review_no_points_message
    * - review_yes_or_no_message
    */

  var opt = $('#review' + id).find('input[name="yes-no-opt'+id+'"]:checked'),
      grade = $('input[name="grade_'+id+'"]:checked'),
      comment = $("#review_comment_"+id).val();

  opt = opt? opt.val() : null;
  grade = grade? grade.val() : null;

  if(opt == "yes"){

    if(grade >= 1){
      return review(id, comment, opt, grade);
    }

    showMessage("Error", review_no_points_message);

  } else if(opt == "no"){
    return review(id, comment, opt);
  } else{

    showMessage("Error", review_yes_or_no_message);
  }

  return false;
}


/* 
********************************************************************************************
AGENT REVIEW
********************************************************************************************
*/

function agentReview(id, comment, opt, grade){

    /* To call this function, it's needed to declare these variables in your view file:
    * - review_action_url - action's url
    * - updated_message - Success message
    */

    grade = grade? grade : 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            next_element = document.getElementById("next_evidence");
            next_element.removeAttribute("disabled");
            next_element.removeAttribute("onClick");
            document.getElementById("post_submit_review").innerHTML = updated_message;
        }
    };
    xhttp.open("GET", review_action_url+"&opt="+opt+"&grade="+grade+"&evidenceId="+id+"&comment="+comment , true);
    xhttp.send();

    return false;
}

function validateAgentReview(id){


  var opt = 'yes'; //always yes for agents
  var grade = document.querySelector('input[name="grade"]:checked');
  var comment = document.getElementById("review_comment").value;
  grade = grade? grade.value : null;

  return agentReview(id, comment, opt, grade);
}

jQuery(document).ready(function () {
  var $submitButton = $('#post_submit_review');
  $submitButton.on('click', function(e){
    $('#review').submit(
        function(){
            return validateAgentReview(document.getElementById("evidence_id").value);
        }
    );
  });
});