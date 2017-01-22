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

<div id="animated-popup" class="animate-submit-evidence" style="display:none">
  <h2 id="animated-popup-header"><?= Yii::t('MissionsModule.base', "Congratulations!") ?></h2>
  <br /><br />
  <h5><?= Yii::t('MissionsModule.base', "You've just won") ?></h5>&nbsp;<h5 id="animated-popup-quantity"></h5>&nbsp;<h5><?= Yii::t('MissionsModule.base', "points in") ?></h5>
  <br />
  <div id="animated-popup-content"></div>
  <br /><br />
  <h5 id="animated-popup-power"></h5>
  <br />
  <div class="animated-trophy"><i class="fa fa-trophy" aria-hidden="true"></i></div>
</div>

<script type="text/javascript">

var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

/*var popUpWatcher = setInterval(function() {

    if(! $("#popup-message").is(':visible') ){
      loadPopUps();
    }

}, 1000); 
*/

var popUpWatcher = null;

function loadPopUps(animatedPopUp){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              var message = JSON.parse(xhttp.responseText);
              
              if(animatedPopUp){
                animatePopUp(message['title'], message['message'], message['image_url']);  
              }else{
                showMessage(message['title'], message['message']);  
              }
              
              //while has an alert to show 
              if(popUpWatcher == null){
                popUpWatcher = setInterval(function() {

                  if(! $("#popup-message").is(':visible') ){
                    loadPopUps(animatedPopUp);
                  }

                }, 1000); 
              }
            }else{
                window.clearInterval(popUpWatcher);
                popUpWatcher = null;
            }
        }
    };
    xhttp.open("GET", "<?= Url::toRoute('/missions/alert/alert'); ?>" , true);
    xhttp.send();
}

function animatePopUp(title, message, image_url){
  document.getElementById("animated-popup-power").innerHTML = title;
  document.getElementById("animated-popup-quantity").innerHTML = message;

  var img = new Image();
  var div = document.getElementById('animated-popup-content');

  img.onload = function() {
    div.appendChild(img);
  };

  img.src = image_url;

  $("#animated-popup").show();
  $("#animated-popup").addClass('animated fadeInUp').one(animationEnd, function() {
      removeAnimation('fadeInUp');
      slideOutPopUp();
  });
}

function slideOutPopUp(){
  $("#animated-popup").addClass('animated fadeInUp').one(animationEnd, function() {
      removeAnimation('fadeInUp');
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
