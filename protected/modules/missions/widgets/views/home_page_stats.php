<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-body row">
            <div class="col-xs-8">
                <div class="panel-heading">
                    <strong>
                        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
                    </strong>
                    <div>
                        Your average rating: 
                    </div>
                </div>
                <div class="panel-body">
                    Every time you submit evidence, your overall rating will improve.
                    To choose an activity in Mission x, click the button below.
                </div>
            </div>
            <div class="col-xs-4">
                <div class="panel-heading">
                    <strong>
                        Your Evocoins
                    </strong>  
                </div>
                <div class="panel-body">
                    Earn Evocoins by reviewing evidence.
                    Your standing in the leadership will increase.
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <strong>
                Super Powers
            </strong>
            Earn points to increase powers
        </div>

        <div class="panel-body">
            <?php foreach($userPowers as $userQuality): ?>
                <div class="col-xs-3">
                    <i class="fa fa-eye fa-5x" aria-hidden="true"></i>
                    <BR>
                        <?= $userQuality[0]->getPower()->getQualityPowers()[0]->getQualityObject()->name; ?>
                    <BR>
                        Level 
                        <?= $userQuality[0]->getUserQuality()->getLevel() ?>
                    <p style="padding-top: 15px;">
                        <strong>
                            Power
                        </strong>
                    </p>
                    <?php foreach($userQuality as $userPower): ?>
                        <div class="power">
                            <?php 
                                $power = $userPower->getPower(); 
                                $percentage = floor($userPower->getCurrentLevelPoints() / $userPower->getNextLevelPoints() * 100) ;
                            ?>
                            <?= isset($power->powerTranslations[0]) ? $power->powerTranslations[0]->title : $power->title ?>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage ?>%;">
                                    <span class="sr-only"></span>
                                </div>
                                <span>
                                </span>
                            </div>     
                            <div class="level">
                                Level <?= $userPower->getLevel() ?>
                            </div>
                            <div class="points">
                                <?= $userPower->getCurrentLevelPoints() ?>
                                /
                                <?= $userPower->getNextLevelPoints() ?>
                            </div> 
                        </div>
                    <?php endforeach; ?>


                </div>
            <?php endforeach; ?>

        </div>

    </div>

</div>

<style type="text/css">

.power{
    padding-bottom: 50px;
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