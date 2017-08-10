<?php

use yii\helpers\Html;

?>

<div class="leaderboard-box" style="padding:0; margin-bottom:60px">
    <div style="text-align:center; background-color:#0F2441; padding:10px">
        <h5 style="color:#FEAE1B; text-transform:uppercase;">
          <?php echo $title ?>
        </h5>
    </div>
    <br />
    <div class="row" style="padding:20px 20px 0">
        <?php foreach($ranking as $key => $r): ?>
            <div class="col-sm-6">
                <div style = "padding: 10px; margin-bottom: 15px; border: 3px solid #0F2441;">

                    <div class="row">
                        <div class="col-sm-10">

                            <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                            <?php 
                                if($profile == 'space'){
                                    echo Html::a($r['name'], ['/space/space', 'sguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']);
                                } else{
                                    echo Html::a(isset($r['name']) ? $r['name'] : $r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']);
                                }
                            ?>

                        </div>
                        <div class="col-sm-2">

                            <span class="l-number"><?php echo $r[$type]; ?>00</span>

                        </div>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>
    </div>


    <br />

    <div style="padding:0 20px 20px">
        <?php if(($status == 'mentor' && Yii::$app->user->getIdentity()->group->name == "Mentors") || ($status == 'default')): ?>
            <?php if(!isset($my_team) || $my_team['position'] == -1): ?>
                <span style = "font-weight: 700; color: #FEAE1B; text-transform: uppercase;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
            <?php else: ?>
                <span style = "font-weight: 700; color: #FEAE1B; text-transform: uppercase;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: #{position}", array('position' => $my_team['position'] + 1)); ?></span><br>
            <?php endif; ?>
        <?php endif; ?>
    </div>

</div>