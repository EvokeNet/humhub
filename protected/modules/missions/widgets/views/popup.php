<?php 
  
  use yii\helpers\Url; 
  $this->registerCssFile("css/animate.min.css"); 

?>
<!-- POPUP -->

<div id="popup-message" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 id="message-title" class="modal-title" style = "font-weight:bold">

        </h2>
      </div>
      <div id="message-content" class="modal-body" style = "text-align:center">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            <?= Yii::t('MissionsModule.base', 'Close') ?>
        </button>
      </div>
    </div>

  </div>
</div>

<div id="animated-popup" style="display: none">
  <h2 id="animated-popup-title"></h2>
  <h2 id="animated-popup-content"></h2>
</div>

<script type="text/javascript">

var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

/*var popUpWatcher = setInterval(function() {

    if(! $("#popup-message").is(':visible') ){
      loadPopUps();
    }

}, 1000); 
*/

function loadPopUps(animatedPopUp){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              var message = JSON.parse(xhttp.responseText);
              if(animatedPopUp){
                animatePopUp(message['title'], message['message']);  
              }else{
                showMessage(message['title'], message['message']);  
              }
              

              //while has an alert to show
              loadPopUps(animatedPopUp);
            }
        }
    };
    xhttp.open("GET", "<?= Url::toRoute('/missions/alert/alert'); ?>" , true);
    xhttp.send();
}

function animatePopUp(title, message){
  document.getElementById("animated-popup-title").innerHTML = title;
  document.getElementById("animated-popup-content").innerHTML = message;
  $("#animated-popup").show();
  $("#animated-popup").addClass('animated slideInUp').one(animationEnd, function() {
      removeAnimation('slideInUp');
      slideOutPopUp();
  });
}

function slideOutPopUp(){
  $("#animated-popup").addClass('animated slideOutUp').one(animationEnd, function() {
      removeAnimation('slideOutUp');
      $("#animated-popup").hide();
  });
}

function removeAnimation(animationName){
  $("#animated-popup").removeClass('animated ' + animationName);
}

function showMessage(title, message){
  document.getElementById("message-title").innerHTML = title;
  document.getElementById("message-content").innerHTML = message;
  $("#popup-message").modal("show");
}



</script>
