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
            <?= Yii::t('MissionsModule.base', 'General Progress Indicator') ?>
        </strong>
    </div>
    <div class="panel-body">

        <div style="margin-top:10px">

        <?php foreach($missions as $m): 

            $p = 0;

            if(count($m->activities) > 0)
                $p = $mission_progress[$m->id]/count($m->activities); 

            //echo $p;

            //echo $mission_progress[$m->id]; echo count($m->activities); ?>
            <span style="display: block;
    float: left;
    margin-top: 4px;
    margin-right: 10px"><?php echo Yii::t('MissionsModule.base', 'MISSION {position}', array('position' => $m['position'])); ?></span>

            <?php if(round($p*100) == 0): ?>

                <div class="progress" style="height:25px">
                  <div class="progress-bar" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#A6AAB2; width:100%">
                    <?= Yii::t('MissionsModule.base', 'NOT STARTED') ?>
                  </div>
                </div><br>

            <?php elseif(round($p*100) == 100): ?>

                <div class="progress" style="height:25px;">
                  <div class="progress-bar" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
                    <?= Yii::t('MissionsModule.base', 'COMPLETED') ?>
                  </div>
                </div><br>

            <?php else: ?>
                
                <div class="progress" style="height:25px">
                  <div class="progress-bar" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?= round($p*100) ?>%">
                    <?php //echo Yii::t('MissionsModule.base', '{number}%', array('number' => round($p*100))); ?>
                    <?php echo Yii::t('MissionsModule.base', '{current} OUT OF {total}', array('current' => $mission_progress[$m->id], 'total' => $mission_total[$m->id])); ?>
                  </div>
                </div><br>

            <?php endif; ?>

        <?php endforeach; ?>

        <?php 
   //       if($will_start_in_one_week == 1): 
      //        echo date("F j, Y", strtotime('today'));
      //        echo date("F j, Y", strtotime($evokation_deadline['start_date'])); 
      //        echo (strtotime($evokation_deadline['finish_date']) == strtotime('today')) ? 'depois' : 'antes';
            // endif; 
        ?>

        <span style="text-align:center; display:block"><?php echo Yii::t('MissionsModule.base', 'EVOKATION'); ?></span>

        <?php if(strtotime($evokation_deadline['start_date']) > strtotime('today')): ?>

            <div class="progress" style="height:25px;">
              <div class="progress-bar" role="progressbar"
              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
                <?= Yii::t('MissionsModule.base', 'STARTING IN {date}', array('date' => date("F j, Y", strtotime($evokation_deadline['start_date'])))) ?>
              </div>
            </div><br>

        <?php elseif((strtotime($evokation_deadline['start_date']) <= strtotime('today')) && (strtotime($evokation_deadline['finish_date']) >= strtotime('today'))): ?>
            
            <div class="progress" style="height:25px">
              <div class="progress-bar" role="progressbar"
              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#28C503; width:100%">
                <?= Yii::t('MissionsModule.base', 'OPEN UNTIL {date}', array('date' => date("F j, Y", strtotime($evokation_deadline['finish_date'])))) ?>
              </div>
            </div><br>

        <?php elseif((strtotime($evokation_deadline['start_date']) < strtotime('today')) && (strtotime($evokation_deadline['finish_date']) < strtotime('today'))): ?>
            
            <div class="progress" style="height:25px">
              <div class="progress-bar" role="progressbar"
              aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="background:#FF4351; width:100%">
                <?= Yii::t('MissionsModule.base', 'CLOSED') ?>
              </div>
            </div><br>

        <?php endif; ?>

        </div>
    </div>
</div>