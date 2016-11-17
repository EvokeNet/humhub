function review(id, comment, opt, grade){

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

function validateReview(id){


  var opt = 'yes'; //always yes for agents
  var grade = document.querySelector('input[name="grade"]:checked');
  var comment = document.getElementById("review_comment").value;
  grade = grade? grade.value : null;

  return review(id, comment, opt, grade);
}

jQuery(document).ready(function () {
  var $submitButton = $('#post_submit_review');
  $submitButton.on('click', function(e){
    $('#review').submit(
        function(){
            return validateReview(document.getElementById("evidence_id").value);
        }
    );

  });
});