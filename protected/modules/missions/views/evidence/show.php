<?php

if(isset($message)):
?>

    <div id="light" class="white_content">
        <?php
            echo $message;
        ?>
        <BR>
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">
            Close
        </a>
    </div>
    <div id="fade" class="black_overlay"></div>

<?php
    endif;

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


<style type="text/css">

    .black_overlay{
        display: block;
        position: absolute;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index:1001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: block;
        position: absolute;
        top: 25%;
        left: 25%;
        width: 50%;
        height: 50%;
        padding: 16px;
        border: 16px solid orange;
        background-color: white;
        z-index:1002;
        overflow: auto;
        text-align: center;
        padding-top: 5%;
    }

</style>
