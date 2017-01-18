<?php use yii\helpers\Url; ?>
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

<script type="text/javascript">

/*var popUpWatcher = setInterval(function() {

    if(! $("#popup-message").is(':visible') ){
      loadPopUps();
    }

}, 1000); 
*/

function loadPopUps(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
              var message = JSON.parse(xhttp.responseText);
              showMessage(message['title'], message['message']);
              //while has an alert to show
              loadPopUps();
            }
        }
    };
    xhttp.open("GET", "<?= Url::toRoute('/missions/alert/alert'); ?>" , true);
    xhttp.send();
}

function showMessage(title, message){
  document.getElementById("message-title").innerHTML = title;
  document.getElementById("message-content").innerHTML = message;
  $("#popup-message").modal("show");
}

</script>
