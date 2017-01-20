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
  <br />
  <h5 id="animated-popup-power"></h5>
  <br />
  <div class="animated-trophy"><i class="fa fa-trophy" aria-hidden="true"></i></div>
</div>

<style>

.animate-submit-evidence{
  position: fixed;
  top: 30%;
  left: 32%;
  width: 500px;
  padding: 90px 50px 70px;
  background-color: #304047;
  color: #fff;
  text-align: center;
  z-index:100;
  border-radius:10px;
  /*box-shadow: 0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;*/
  -webkit-box-shadow: 0px 0px 30px 0px rgba(50, 50, 50, 0.75);
  -moz-box-shadow:    0px 0px 30px 0px rgba(50, 50, 50, 0.75);
  box-shadow:         0px 0px 30px 0px rgba(50, 50, 50, 0.75);
  opacity: 0.8;
}

.animated-trophy{
    position: absolute;
    top: -100px;
    left: 30%;
    border: 10px solid #304047;
    background-color: #FFC107;
    padding: 20px 25px;
    border-radius: 50%;
}

#animated-popup{
  -webkit-animation-duration: 3s;
  -webkit-animation-delay: 0s;
}

#animated-popup-content{
  margin-top:50px;
}

#animated-popup-content img{
  width:90px;
  border: 5px solid #00BCD4;
  border-radius: 50%;
}

.animate-submit-evidence h2{
  color:#FFC107!important;
}

.animate-submit-evidence h5{
  color: #fff;
  display:inline;
}

.animate-submit-evidence i{
  font-size: 10em;
}

</style>

<script type="text/javascript">

var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

/*var popUpWatcher = setInterval(function() {

    if(! $("#popup-message").is(':visible') ){
      loadPopUps();
    }

}, 1000); 
*/

var popUpWatcher = null;
var animated_popup_image = null;
var animated_popup_content = document.getElementById('animated-popup-content');
var lastMessage = null;

function loadPopUps(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              var message = JSON.parse(xhttp.responseText);

              //if duplicated messages
              if(lastMessage === xhttp.responseText){
                // do nothing
              }else if(message['type'] == 'animated'){
                console.log("animate");
                animatePopUp(message['title'], message['message'], message['image_url']);  
              }else{
                showMessage(message['title'], message['message']);  
              }

              //update old message
              lastMessage = xhttp.responseText;
              
              //while has an alert to show 
              if(popUpWatcher == null){
                popUpWatcher = setInterval(function() {

                  if(!$("#popup-message").is(':visible') && !$("#animated-popup").is(':visible')){
                    console.log("load another");
                    loadPopUps();
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

  animated_popup_image = new Image();

  animated_popup_image.onload = function() {
    animated_popup_content.appendChild(animated_popup_image);
  };

  animated_popup_image.src = image_url;

  $("#animated-popup").show();
  slideOutPopUp();
}

// not working
function slideInPopUp(){
  $("#animated-popup").addClass('animated fadeInUp').one(animationEnd, function() {
       //removeAnimation('fadeInUp');
       slideOutPopUp();
   });
}

function slideOutPopUp(){
  $("#animated-popup").addClass('animated fadeInUp').one(animationEnd, function() {
      animated_popup_content.removeChild(animated_popup_image);
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
