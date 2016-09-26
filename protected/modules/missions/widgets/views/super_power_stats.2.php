<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Evidence;

?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h4 class = "display-inline"><?php echo Yii::t('MissionsModule.base', 'Super Powers'); ?></h4>
        <p style = "display:inline; margin-left:10px"><?php echo Yii::t('MissionsModule.base', 'Earn points to increase powers'); ?></p>
    </div>

    <div class="panel-body row">
        <?php foreach($userPowers as $userQuality): $quality = $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject(); ?>
        <?php
            $unavailable_power = $userQuality[0]->getUserQuality() == null || $userQuality[0]->getUserQuality()->getLevel() <= 0 ? true : false;
            
            // var_dump($quality->qualityTranslations[0]);
            // var_dump(Yii::$app->language);
            
            $name = $quality->name;
            
            if(Yii::$app->language == 'es' && isset($quality->qualityTranslations[0]))
                $name = $quality->qualityTranslations[0]->name;
            
        ?>
            <div class="<?= $unavailable_power ? 'unavailable-power' : '' ?>" style = "margin-bottom:50px">
                

                <div class="row">
                    <div class="col-xs-3">


                    <div style = "margin-bottom:20px; text-align: center">
                        <div>
                            <img src = "<?php echo $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->image; ?>" width=80 class = "power-border"></img>
                        </div>
                        <div>
                            <h6 style = "margin-left:4px;"><?= $name; ?></h6>
                            <span style = "color: #28C503; margin-left:5px"><?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => null != $userQuality[0]->getUserQuality() ? $userQuality[0]->getUserQuality()->getLevel() : 0)); ?></span>
                        </div>
                    </div>

                
                </div>
                


                <div class="col-xs-9">
                
                <?php 
                
                    foreach($userQuality as $userPower):
                    
                    $power = $userPower->getPower();
                    $percentage = floor($userPower->getCurrentLevelPoints() / $userPower->getNextLevelPoints() * 100);
                    
                    $power_name = $power->title;
            
                    if(Yii::$app->language == 'es' && isset($power->powerTranslations[0]))
                        $power_name = $power->powerTranslations[0]->title;
                             
                ?>
                
                    <div style = "margin-bottom:20px">
                        
                        <div class="row">
                            <div class="col-xs-1">
                                <h1 style = "font-size: 40pt; margin-top:0"><?= $userPower->getLevel() ?></h1>
                            </div>
                            <div class="col-xs-11">
                        
                                <div style = "margin-bottom:10px">     
                                    <div style="display:inline">
                                        <span style="display:inline"><?= $power_name ?></span>
                                    </div>                         
                                    <div style = "float: right; display:inline">
                                        <span><?php echo Yii::t('MissionsModule.base', 'Points to Level: {total}', array('total' => ($userPower->getRemainingPointsToLevelUp()))) ?></span>
                                    </div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%;">
                                        <span class="sr-only"></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>

                </div>
                </div>
  
            </div>
        <?php endforeach; ?>

    </div>

</div>

<style type="text/css">

.evokecoin {
    width: 50px;
    height: 50px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.42;
    border-radius: 20px;
    display: inline-block;
    font-size: 26px;
}

.power{
    margin-bottom: 20px;
}

.power .level{
    float: left;
}

.power .points{
    float: right;
}

.unavailable-power{
    opacity: 0.5;
}

.unavailable-power span, h6{
    color: gray !important;
}


</style>
