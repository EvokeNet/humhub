<?php
use Yii;
use \yii\helpers\Url;
?>

<!-- POPUP -->

<div id="popup-message" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">
            Congratulations!
        </h4>
      </div>
      <div id="message-content" class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
            Close
        </button>
      </div>
    </div>

  </div>
</div>

<?php

echo \humhub\modules\missions\widgets\WallCreateForm::widget([
    'contentContainer' => $contentContainer,
    'submitButtonText' => Yii::t('MissionsModule.widgets_EvidenceFormWidget', 'Submit Evidence'),
    'activity' => $activity,
]);
?>

<?php

$canCreateEvidences = $contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence());

echo \humhub\modules\content\widgets\Stream::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/missions/evidence/stream',
    'messageStreamEmpty' => ($canCreateEvidences) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet!'),
    'messageStreamEmptyCss' => ($canCreateEvidences) ? 'placeholder-empty-stream' : '',
    'filters' => [
    ]
));

?>

<script type="text/javascript">

setInterval(function() {
    loadPopUps();
}, 2000); 

function loadPopUps(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if(xhttp.responseText){
                document.getElementById("message-content").innerHTML = xhttp.responseText;
                $("#popup-message").modal("show");
            }
        }
    };
    xhttp.open("GET", "<?= $space->createUrl('/missions/evidence/alert'); ?>" , true);
    xhttp.send();
}

</script>
