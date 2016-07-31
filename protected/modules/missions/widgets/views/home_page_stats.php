<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Evidence;
use humhub\modules\space\models\Membership;
use app\modules\coin\models\Wallet;
use app\modules\teams\models\Team;
use humhub\modules\space\models\Space;

$team_id = Team::getUserTeam(Yii::$app->user->getIdentity()->id);
if($team_id){
    $member = Membership::findOne(['space_id' => $team_id]);
    $team = $member->space;
}else{
    $member = null;
    $team = Space::findOne(['name' => 'Mentors']);
}


$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);

$avg = number_format((float) Evidence::getUserAverageRating(Yii::$app->user->getIdentity()->id), 1, '.', '');

?>

<div class="panel panel-default">
    <div class="panel-body row">
        <div class="col-xs-<?= $member? '7' : '0'?>">
            <?php if($member): ?>
            <div class="panel-heading" style = "height: 90px;">

                <h4 class = "display-inline">
                    <strong>
                        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
                    </strong>
                </h4>
                
                    <a id="submit_evidence" class="btn btn-cta1" style="float: right;  margin-top:5px" href="<?= Url::to(['/missions/evidence/missions', 'sguid' => $member->space->guid]); ?>">
                        <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
                    </a>

                <br>
                <p style = "margin-top:10px">
                    <?= Yii::t('MissionsModule.base', 'Your average rating: {avg}', array('avg' => $avg)) ?>
                </p>
            </div>

            <div class="panel-body">
               <p><?= Yii::t('MissionsModule.base', 'Every time you submit evidence, your overall rating will improve.') ?><p>
            </div>
            <?php endif; ?>
        </div>
        <div class="col-xs-<?= $member? '5' : '12'?>">

            <div class = "grey_box">
                <div style = "position:relative; height:90px">

                        <div style = "position:absolute; left:0; width:50%">
                            <h6><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></h6>
                            <p style = "font-size:9pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>
                        </div>

                        <div style = "position:absolute; right:0; top:10px">
                            <div class = "home-widget-evocoins">
                                <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "<?= $member? '70' : '120'?>px">
                                <div>
                                    <p class="<?= $member? '' : 'mentor_evocoins'?>">
                                        <?= $wallet->amount ?>
                                    </p>
                                </div>
                            </div>
                        </div>

                </div>

                <br>
                <div class = "text-center">
                    <a class = "btn btn-cta1 <?= $member? '' : 'mentor_review'?>" href='<?= Url::to(['/missions/review/index', 'sguid' => $team->guid]) ?>'>
                            <?= Yii::t('MissionsModule.base', 'Review Evidence') ?>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style type="text/css">

.mentor_evocoins{
    font-size: 28px !important;
}

.mentor_review {
    float: left;
}

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
