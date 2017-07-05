<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Missions');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Missions');

?>

<h4 style="background-color: #0F2441; text-align: center; padding: 10px 0; margin: 40px 0 20px; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.base', 'MISSIONS'); ?></h4>

<?php 
    $x = 0;
    if (count($missions) != 0): ?>
    
    <?php foreach ($missions as $mission): ?>
        
        <?php if($mission->locked == 1): ?>
            
            <div class="panel panel-default">
                <div class="panel-body grey-box blur">
                    
                    <span class="fa-stack fa-2x" style="color: #FEAE1B;">
                      <i class="fa fa-circle-thin fa-stack-2x"></i>
                      <strong class="fa-stack-1x calendar-text"><?php echo $mission->position >= 1 ?$mission->position : "#" ?></strong>
                    </span>

                    <h6 style="line-height:30px; display: inline; margin-left: 12px;">
                        <?php echo Html::a(
                            Yii::t('MissionsModule.base', '{mission}', array('mission' => isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title)),
                            ['activities', 'missionId' => $mission->id, 'sguid' => $contentContainer->guid]); ?>
                    </h6>

                </div>
            </div>
            
        <?php else: ?>
            
            <div class="panel panel-default">
                <div class="panel-body grey-box">

                    <span class="fa-stack fa-2x" style="color: #FEAE1B;">
                      <i class="fa fa-circle-thin fa-stack-2x"></i>
                      <strong class="fa-stack-1x calendar-text"><?php echo $mission->position >= 1 ?$mission->position : "#" ?></strong>
                    </span>

                    <h6 style="line-height:30px; display: inline; margin-left: 12px;">
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

<style>

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
