<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Missions');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.page_titles', 'Missions');

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4><?= Yii::t('MissionsModule.base', 'MISSIONS') ?></h4>
    </div>
    <div class="panel-body text-center">

        <?php if(isset($missions)): ?>

            <?php foreach ($missions as $mission): ?>
        
                <?php if($mission->locked == 1): ?>
                    <div class="grey-box" style="height:100px; text-align:initial; padding:7px 10px; margin-bottom: 15px">
                        <span class="fa-stack fa-lg vertically-align">   
                          <i class="fa fa-circle-thin fa-stack-2x"></i>
                          <strong class="fa-stack-1x calendar-text"><?php echo $mission->position >= 1 ?$mission->position : "#" ?></strong>
                        </span>

                        <p style="display:inline; margin:10px 20px 0"><?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title ?></p><br><br>

                        <div style="display: inline; margin-left: 60px;" data-toggle="tooltip" title="<?php echo Yii::t('MissionsModule.base', "This mission is currently locked"); ?>"><i class="fa fa-lock fa-2x" aria-hidden="true"></i></div>
                    </div>
                <?php else: ?>
                    <div class="grey-box" style="height:100px; text-align:initial; padding:7px 10px; margin-bottom: 15px">
                        <span class="fa-stack fa-lg vertically-align" style="color: #FEAE1B;">   
                          <i class="fa fa-circle-thin fa-stack-2x"></i>
                          <strong class="fa-stack-1x calendar-text"><?php echo $mission->position >= 1 ?$mission->position : "#" ?></strong>
                        </span>

                        <?php echo Html::a(
                            Yii::t('MissionsModule.base', '{mission}', array('mission' => isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title)),
                            ['activities', 'missionId' => $mission->id, 'sguid' => $contentContainer->guid], ['style' => 'margin: 10px 20px 0; font-size:12pt']); ?><br><br>
                            
                        <?php if($mission_progress[$mission->id] == $mission_total[$mission->id] && $mission_total[$mission->id] != 0): ?>

                            <div style="display: inline; margin-left: 60px; color: #28C503" data-toggle="tooltip" title="<?php echo Yii::t('MissionsModule.base', "You've completed this mission"); ?>"><i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i></div>

                        <?php else: ?>
                            <p style="display: inline; margin-left: 60px; font-size:10pt"><?php echo Yii::t('MissionsModule.base', '{current} / {total} activities completed', array('current' => $mission_progress[$mission->id], 'total' => $mission_total[$mission->id])); ?></p>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

            <?php endforeach; ?>

        <?php else: ?>    
            <p><?php echo Yii::t('MissionsModule.base', 'No missions created yet!'); ?></p>
        <?php endif; ?>

    </div>
</div>

<style>

.vertically-align{
  position: relative;
  top: 50%;
  transform: perspective(1px) translateY(-50%);
}

.grayed-out{
    opacity: 0.4;
    filter: alpha(opacity=30); /* msie */
    background-color: #000;
}

.calendar-stack {
    position: relative;
    display: inline-block;
    width: (13em / 14);
    height: 1em;

    .icon-calendar-empty,
    .calendar-day {
        position: absolute;
    }

    .calendar-day {
        top: (7em / 8);
        left: (1em / 8);
        width: (11em / 8);
        height: (6em / 8);
        font-family: sans-serif;
        font-size: (8em / 14);
        font-weight: 700;
        line-height: (8em / 14);
        text-align: center;
    }
}
</style>

<!-- <div class="panel panel-default">
    <div class="panel-heading">
        <h4 style="margin-top:10px"><strong><?php echo Yii::t('MissionsModule.base', 'Missions'); ?></strong></h4>
    </div>
    <div class="panel-body">
        <br />
        <?php 
            $x = 0;
            if (count($missions) != 0): ?>
            
            <?php foreach ($missions as $mission): ?>
                
                <?php if($mission->locked == 1): ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-body grey-box blur">
                            
                            <h6 style="line-height:30px">
                                <span class = "activity-number">
                                        <?php echo $mission->position >= 1 ?$mission->position : "#" ?>
                                </span>
                                <?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title ?>
                            </h6>

                        </div>
                    </div>
                    
                <?php else: ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-body grey-box">

                            <h6 style="line-height:30px">
                                <span class = "activity-number">
                                        <?php echo $mission->position >= 1 ?$mission->position : "#" ?>
                                </span>
                                <?php echo Html::a(
                                    Yii::t('MissionsModule.base', '{mission}', array('mission' => isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title)),
                                    ['activities', 'missionId' => $mission->id, 'sguid' => $contentContainer->guid]); ?>
                            </h6>

                        </div>
                    </div>
                
                <?php endif; ?>
                
            <?php endforeach; ?>
            
        <?php else: ?>
            <p><?php echo Yii::t('MissionsModule.base', 'No missions created yet!'); ?></p>
        <?php endif; ?>
    </div>
</div> -->
