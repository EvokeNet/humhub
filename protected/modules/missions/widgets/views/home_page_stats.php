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
            <?php for($x = 1; $x <= 4; $x++): ?>
                <div class="col-xs-3">
                    <i class="fa fa-eye fa-5x" aria-hidden="true"></i>
                    <BR>Creative Visionary
                    <BR>Level 2

                    <p style="padding-top: 15px;">
                        <strong>
                            Power
                        </strong>
                    </p>
                    <?php for($y = 1; $y <= 5; $y++): ?>
                        <div class="power">
                            Imagination
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                                    <span class="sr-only"></span>
                                </div>
                                <span>
                                </span>
                            </div>     
                            <div class="level">
                                Level 2
                            </div>
                            <div class="points">
                                24/50
                            </div> 
                        </div>
                    <?php endfor; ?>


                </div>
            <?php endfor; ?>

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