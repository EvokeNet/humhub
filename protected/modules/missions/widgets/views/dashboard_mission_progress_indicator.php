<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Activities;
use app\modules\missions\models\Evidence;

?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'Progress Towards Evokation') ?>
        </strong>
    </div>
    <div class="panel-body" style="padding:10px 12px">

        <div style="margin:20px 0 25px">

          <?php $width = (100/(count($missions)+1)); foreach ($missions as $key => $m) { ?>
            <span style="width: <?=$width?>%; display: block; float: left; color:#03ACC5;"><?php echo Yii::t('MissionsModule.base', 'M{position}', array('position' => $m['position'])); ?></span>
          <?php } ?>
          <span style="width: <?=$width?>%; display: block; float: left; color:#03ACC5;"><?php echo Yii::t('MissionsModule.base', 'Evokation'); ?></span>
        </div><br>

        <div style="margin-top:10px">

        <?php 
          $p = $activities_completed / $total_activities;
          $percentage = round($p*100); 
          //in case there is no completed mission yet
          if($latest_completed_mission < 0){
            $latest_completed_mission = 0;
          }
        ?>

            <?php if($percentage == 0): ?>

                <!-- <span style="text-align:center; display:block; font-weight:700"><?php echo Yii::t('MissionsModule.base', 'MISSION PROGRESS'); ?></span> -->

                <div class="progress" style="height:25px">
                  <div class="progress-bar" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#A6AAB2; width:100%">
                    <span style="color:#101C2A; font-weight:700"><?= Yii::t('MissionsModule.base', 'NOT STARTED') ?></span>
                  </div>
                </div>

            <?php elseif($percentage == 100): ?>

                <div class="progress" style="height:25px;">
                  <div class="progress-bar" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
                    <span style="color:#101C2A; font-weight:700"><?= Yii::t('MissionsModule.base', 'COMPLETED') ?></span>
                  </div>
                </div>

            <?php else: ?>         

                <div class="progress" style="height:25px">
                  <div class="progress-bar" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= round($p*100) ?>%">
                    <span style="font-weight:700">
                      <?= $percentage."%" ?>
                    </span>
                  </div>
                </div>

                <span style="text-align:center; display:block; font-weight:700; margin:10px 0 2px;">
                <?php if($missing_activities>=1): ?>
                  <?php echo Yii::t('MissionsModule.base', 'Currently on Mission {current}', array('current' => $latest_completed_mission+1)); ?>
                <?php else: ?>
                  <?php echo Yii::t('MissionsModule.base', 'Currently on Evokation'); ?>
                <?php endif; ?>
                </span>

                <?php if($missing_activities>=2): ?>
                  <span style="text-align:center; display:block; font-weight:700; font-size:8pt"><?php echo Yii::t('MissionsModule.base', '{missing_activities} activities for next mission.', array('missing_activities' => $missing_activities)); ?></span>  
                <?php elseif($missing_activities == 1): ?>
                  <span style="text-align:center; display:block; font-weight:700; font-size:8pt"><?php echo Yii::t('MissionsModule.base', '{missing_activities} activity for next mission.', array('missing_activities' => $missing_activities)); ?></span>  
                <?php else: ?>
                  <span style="text-align:center; display:block; font-weight:700; font-size:8pt"><?php echo Yii::t('MissionsModule.base', 'Submit Evokation') ?></span>  
                <?php endif; ?>

            <?php endif; ?>

            <br>

        <?php 
   //       if($will_start_in_one_week == 1): 
      //        echo date("F j, Y", strtotime('today'));
      //        echo date("F j, Y", strtotime($evokation_deadline['start_date'])); 
      //        echo (strtotime($evokation_deadline['finish_date']) == strtotime('today')) ? 'depois' : 'antes';
            // endif; 
        ?>

        <!-- <span style="text-align:center; display:block"><?php echo Yii::t('MissionsModule.base', 'EVOKATION'); ?></span>

        <?php if(strtotime($evokation_deadline['start_date']) > strtotime('today')): ?>

            <div class="progress" style="height:25px;">
              <div class="progress-bar" role="progressbar"
              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
                <span style="color:#101C2A; font-weight:700"><?= Yii::t('MissionsModule.base', 'STARTING IN {date}', array('date' => date("F j, Y", strtotime($evokation_deadline['start_date'])))) ?></span>
              </div>
            </div><br>

        <?php elseif((strtotime($evokation_deadline['start_date']) <= strtotime('today')) && (strtotime($evokation_deadline['finish_date']) >= strtotime('today'))): ?>
            
            <div class="progress" style="height:25px">
              <div class="progress-bar" role="progressbar"
              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
                <span style="color:#101C2A; font-weight:700"><?= Yii::t('MissionsModule.base', 'OPEN UNTIL {date}', array('date' => date("F j, Y", strtotime($evokation_deadline['finish_date'])))) ?></span>
              </div>
            </div><br>

        <?php elseif((strtotime($evokation_deadline['start_date']) < strtotime('today')) && (strtotime($evokation_deadline['finish_date']) < strtotime('today'))): ?>
            
            <div class="progress" style="height:25px">
              <div class="progress-bar" role="progressbar"
              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#FF4351; width:100%">
                <span style="color:#101C2A; font-weight:700"><?= Yii::t('MissionsModule.base', 'CLOSED') ?></span>
              </div>
            </div><br>

        <?php endif; ?> -->

        </div>
    </div>
</div>