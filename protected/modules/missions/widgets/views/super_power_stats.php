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
        <?php foreach($userPowers as $userQuality): ?>
            <div class="col-xs-3 text-center">
                <div style = "height: 175px;">
                  <img src = "<?php echo $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->image; ?>" width=100 class = "power-border"></img>

                  <h6><?= $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->name; ?></h6>

                  <span style = "color: #28C503"><?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => null != $userQuality[0]->getUserQuality() ? $userQuality[0]->getUserQuality()->getLevel() : 0)); ?></span>
                
                </div>

                <br><br><span class="label label-secondary"><?php echo Yii::t('MissionsModule.base', 'Powers'); ?> </span><br><br>

                <?php foreach($userQuality as $userPower): ?>
                    <div class="power">
                        <?php
                            $power = $userPower->getPower();
                            $percentage = floor($userPower->getCurrentLevelPoints() / $userPower->getNextLevelPoints() * 100) ;
                        ?>

                        <p class = "text-center"><?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?></p>

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%;">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                        <div class="level italic">
                            <?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => $userPower->getLevel())); ?>
                        </div>

                        <div class="points italic">
                            <?php echo Yii::t('MissionsModule.base', '{points} / {total}', array('points' => $userPower->getCurrentLevelPoints(), 'total' => $userPower->getNextLevelPoints())); ?>
                        </div>

                    </div>
                <?php endforeach; ?>


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

.unavailable{
    color: white;
    text-shadow: -0.5px 0 gray, 0 0.5px gray, 2px 0 gray, 0 -0.5px gray;
}

.unavailable:hover{
    color: white;
}

</style>
