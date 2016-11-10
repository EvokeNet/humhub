<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\missions\models\Evokations;
use app\modules\missions\models\EvokationDeadline;
use app\modules\teams\models\Team;

$user = Yii::$app->user->getIdentity();

$voting_deadline = EvokationDeadline::getVotingDeadline();
$deadline = EvokationDeadline::getEvokationDeadline();

$this->title = Yii::t('MissionsModule.evokation_Home', 'Evokations');
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.evokation_Home', "{name}'s Evokation", array('name' => $contentContainer->name));

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$hasTeamSubmittedEvokation = Evokations::hasTeamSubmittedEvokation($contentContainer->id);

$this->pageTitle = Yii::t('MissionsModule.evokation_Home', "{name}'s Evokation", array('name' => $contentContainer->name));

$total = 0;
$done = 0;

foreach($missions as $m):

    foreach($m->activities as $activity):
        $total++;
        foreach ($activity->evidences as $evidence):
            if($evidence->content->space_id == $contentContainer->id){
                $done++;
                break;
            }
        endforeach;
    endforeach;

endforeach;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <div style="color: red">
            <?php if($voting_deadline && $voting_deadline->hasEnded()): ?>
                <?php echo Yii::t('MissionsModule.evokation_Home', "Voting Closed"); ?>
            <?php endif; ?>
        </div>
        <?php if(Setting::Get('enabled_evokations')): ?>
            <?php if(!$hasTeamSubmittedEvokation && Yii::$app->user->getIdentity()->id == $contentContainer->created_by && $deadline && $deadline->isOccurring()): ?>
                <a class = "btn btn-cta2" href='<?= Url::to(['/missions/evokations/submit', 'sguid' => $contentContainer->guid]); ?>' style = "margin-top:10px">
                    <?= Yii::t('MissionsModule.evokation_Home', 'Submit Elevator Pitch') ?>
                </a>
            <?php elseif($hasTeamSubmittedEvokation && $deadline && $deadline->isOccurring()): ?>
                <a class = "btn btn-cta2" href='<?= Url::to(['/missions/evokations/submit', 'sguid' => $contentContainer->guid]); ?>' style = "margin-top:10px">
                    <?= Yii::t('MissionsModule.evokation_Home', 'See Elevator Pitch') ?>
                </a>
            <?php endif; ?>

            <?php if($voting_deadline && $voting_deadline->isOccurring()): ?>
                <a class = "btn btn-cta2" href='<?= Url::to(['/missions/evokations/voting', 'sguid' => $contentContainer->guid]); ?>' style = "margin-top:10px">
                    <?= Yii::t('MissionsModule.evokation_Home', 'Vote on Evokations') ?>
                </a>
            <?php elseif($voting_deadline && $voting_deadline->hasEnded()): ?>
                <a class = "btn btn-cta2" href='<?= Url::to(['/missions/evokations/list', 'sguid' => $contentContainer->guid]); ?>' style = "margin-top:10px">
                    <?= Yii::t('MissionsModule.evokation_Home', 'See results') ?>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <!--<div style = "margin-top:10px; float:right">
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= floor(($done/$total)*100) ?>%;">
                    <span class="sr-only"></span>
                </div>
            </div>
            <p><?= Yii::t('MissionsModule.evokation_Home', 'Team Progress: {number}%', array('number' => floor(($done/$total)*100))) ?></p>
        </div>-->

        <h2><strong><?php echo Yii::t('MissionsModule.evokation_Home', "{name}'s Evokation", array('name' => $contentContainer->name)); ?></strong></h2>

    </div>
    <div class="panel-body">
      <div class="evokation-prompt">
        <p>
          <?php echo nl2br(Yii::t('MissionsModule.evokation_Home', "Agent, here you can check together with your team the draft of your Evokation. Remember that team captains should send the video summary about your proposed solution, or better known as Elevator Pitch.")); ?>
        </p>
        <p>
          <?php echo nl2br(Yii::t('MissionsModule.evokation_Home', "<Strong> This video will be the basis that other agents and mentors will take to know whether or not to invest in your Evokation. </ Strong>")); ?>
        </p>
        <p>
          <?php echo nl2br(Yii::t('MissionsModule.evokation_Home', "If you achieve enough investment (to be within the top 10), an expert committee will evaluate the final Evokation document to decide the winners.")); ?>
        </p>
        <p>
          <?php echo nl2br(Yii::t('MissionsModule.evokation_Home', "Remember to review the feedback you received from mentors and other agents, as well as weekly reflections, to update the final Evokation document before handing it over to your mentor teachers and finalizing it on the platform.")); ?>
        </p>
        <p>
          <?php echo nl2br(Yii::t('MissionsModule.evokation_Home', "You can access it through the following link:")); ?>
        </p>
      </div>

      <?php
        //  gdrive url is always edited by space setting
        $evokation_id = -1;

      ?>

        <?php if($user->super_admin == 1 || Team::getUserTeam($user->id) == $contentContainer->id): ?>
        <!-- admin or user's team-->

            <div id="gdrive_url">
                <b>
                    <?= Yii::t('MissionsModule.evokation_Home', 'Google Drive URL:') ?>
                </b>

                <?php

                    //fix url
                    if($gdrive_url != "" && substr( $gdrive_url, 0, 7 ) != "http://" && substr( $gdrive_url, 0, 8 ) != "https://"){
                        $gdrive_url = "http://" . $gdrive_url;
                    }
                ?>

                <a id="gdrive_url<?= $evokation_id ?>" href='<?= $gdrive_url ?>' target="_blank">
                    <?= $contentContainer->name ?> <?= Yii::t('MissionsModule.evokation_Home', 'Google Drive URL') ?>
                </a>
                <br /><br />

                <?php if($user->super_admin == 1): ?>
                    <a id="btn_update_url" class="btn btn-cta2" onClick='updateEvokationUrl(<?= $evokation_id ?>)' >
                        <?= Yii::t('MissionsModule.evokation_Home', 'Update') ?>
                    </a>
                <?php endif; ?>
            </div>
        <br>
        <?php endif; ?>

        <?php
        $x = 0;
        if (count($categories) != 0):

        foreach ($categories as $category): $x++;?>

        <div class="panel-group" role="tablist">
            <div class="panel panel-default">

                <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
                    <h4 class="panel-title">
                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup<?=$x?>" aria-expanded="true" aria-controls="collapseListGroup1">
                            <?= isset($category->evokationCategoryTranslations[0]) ? $category->evokationCategoryTranslations[0]->title : $category->title ?>
                        </a>
                    </h4>
                </div>

                <div id="collapseListGroup<?=$x?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true">
                    <ul class="list-group">
                        <?php foreach ($category->activities as $activity):
                            if($activity->mission->locked == 0): ?>
                            <li class="list-group-item">

                                <?php

                                $a = isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title;
                                // echo Html::a(
                                // $a,
                                // ['evidences', 'activities', 'categoryId' => $mission->id, 'sguid' => $contentContainer->guid]);

                                echo Html::a($a, ['evidence/show', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], ['class' => 'profile-link']);

                                $is_complete = false;

                                foreach ($activity->evidences as $evidence):
                                    if($evidence->content->space_id==$contentContainer->id)
                                        $is_complete = true;
                                endforeach;

                                if($is_complete): ?>
                                    <span style = "float:left; margin-right:10px"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>
                                <?php else: ?>
                                    <span style = "float:left; margin-right:10px"><i class="fa fa-circle-o" aria-hidden="true"></i></span>
                                <?php endif;  ?>

                                <span class="label label-default" style = "margin-left:10px"><?= isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title ?></span>

                            </li>
                        <?php endif; endforeach; ?>
                        <!--<li class="list-group-item">Bootply</li>
                        <li class="list-group-item">One itmus ac facilin</li>
                        <li class="list-group-item">Second eros</li> -->
                    </ul>
                    <!--<div class="panel-footer">Footer</div> -->
                </div>

             </div>
        </div>

        <?php endforeach; ?>

                <?php else: ?>
                    <p><?php echo Yii::t('MissionsModule.evokation_Home', 'No categories created yet!'); ?></p>
                <?php endif; ?>

    </div>
</div>

<script>

function updateEvokationUrl(id){

    button = document.getElementById("btn_update_url");

    if(button){

        button = document.getElementById("btn_update_url");

        button.innerHTML = "Save";
        button.id = "btn_save_url";

        // get current element
        element = document.getElementById("gdrive_url"+id);

        // create new one
        new_element = document.createElement('input');
        new_element.setAttribute("type","text");
        new_element.setAttribute("id", element.getAttribute("id"));
        new_element.setAttribute("value", element.getAttribute("href"));
        new_element.setAttribute("onChange", "updateInput(this.id, this.value)");

        //switch
        element.parentNode.replaceChild(new_element,element);

    }else{
        button = document.getElementById("btn_save_url");

        button.innerHTML = "Update";
        button.id = "btn_update_url";

        // get current element
        element = document.getElementById("gdrive_url"+id);

        // update url
        $.ajax({
                url: "<?= $contentContainer->createUrl('/missions/evokations/update_gdrive_url') ?>",
                type: 'post',
                data: {url: element.getAttribute("value"), id: id},
                dataType: 'json',
                success: function (data) {
                    if(data.status == 'success'){
                        showMessage("<?= Yii::t('MissionsModule.evokation_Home', 'Updated') ?>", "<?= Yii::t('MissionsModule.evokation_Home', 'Evokation updated!') ?>");
                    }else if(data.status == 'error'){
                        showMessage("<?= Yii::t('MissionsModule.evokation_Home', 'Error') ?>", "<?= Yii::t('MissionsModule.evokation_Home', 'Something went wrong') ?>");
                    }
                }
            }
        );

        // create new one
        new_element = document.createElement('a');
        new_element.setAttribute("id", element.getAttribute("id"));
        new_element.setAttribute("href", element.getAttribute("value"));
        new_element.innerHTML = "<?= $contentContainer->name ?> Google Drive URL";

        //switch
        element.parentNode.replaceChild(new_element,element);
    }
}


function updateInput(id, value){
    document.getElementById(id).setAttribute("value", value);
}

</script>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
