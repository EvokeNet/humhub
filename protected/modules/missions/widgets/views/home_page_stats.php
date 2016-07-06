<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Evidence;
use humhub\modules\space\models\Membership;
use app\modules\coin\models\Wallet;

$member = Membership::find()
->where(['user_id' => Yii::$app->user->getIdentity()->id])
->orderBy('space_id DESC')
->one();

$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);

?>

<div class="panel-group">
    <div class="panel panel-default">
        <div class="panel-body row">
            <div class="col-xs-7">
                <div class="panel-heading">
                    <strong>
                        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
                    </strong>
                    <a id="submit_evidence" class="btn btn-primary" style="float: right;" href="<?= Url::to(['/missions/evokation/index', 'sguid' => $member->space->guid]); ?>">
                        <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
                    </a>
                    <div>
                        Your average rating: <?= number_format((float) Evidence::getUserAverageRating(Yii::$app->user->getIdentity()->id), 1, '.', '') ?>
                    </div>
                </div>
                <div class="panel-body">
                    Every time you submit evidence, your overall rating will improve.
                </div>
            </div>
            <div class="col-xs-5" style="text-align: center;">
                <div class="col-xs-9">
                    <div class="panel-heading"  style="text-align: left;">
                        <strong>
                            Your Evocoins
                        </strong>  
                    </div>
                    <div class="panel-body"  style="text-align: justify;">
                        Earn Evocoins by reviewing evidence.
                    </div>
                </div>

                <div class="col-xs-3" style="padding-top: 20%;">
                    <div class="btn-default evokecoin">
                        <?= $wallet->amount ?>
                    </div> 
                </div>

                <a class = "btn btn-info" href='<?= Url::to(['/missions/review/index', 'sguid' => $member->space->guid]) ?>'>
                        <?= Yii::t('MissionsModule.base', 'Review Evidence') ?>
                </a> 
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
                        <?php // $userQuality[0]->getPower()->getQualityPowers()[0]->getQualityObject()->name; ?>
                    <BR>
                        Level 
                        <?php // $userQuality[0]->getUserQuality()->getLevel() ?>
                    <p style="padding-top: 15px;">
                        <strong>
                            Power
                        </strong>
                    </p>
                    <?php foreach($userQuality as $userPower): ?>
                        <div class="power">
                            <img src = "<?php echo $userPower->getPower()->image; ?>" width=100></img>
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