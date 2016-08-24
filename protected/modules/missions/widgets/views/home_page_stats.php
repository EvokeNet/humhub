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
    $space = $member->space;
}else{
    $member = null;
    $space = Space::findOne(['name' => 'Mentors']);
}


$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);

$avg = number_format((float) Evidence::getUserAverageRating(Yii::$app->user->getIdentity()->id), 1, '.', '');

?>

<?php if(Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class = "grey_box">
                <div class = "row">
                    
                    <div class = "col-sm-7">
                        <h4><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></h4>
                        <p style = "font-size:12pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>
                    </div>

                    <div class = "col-sm-5 text-center">
                        <div class = "home-widget-evocoins" style = "margin-left:30px">

                            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "120px">
                            <div><p style = "font-size:15pt"><?= $wallet->amount ?></p></div>
                        </div>
                        
                        <br>
                        <?php if($space): ?>
                        <div style = "margin-top:20px">
                            <a class = "btn btn-cta1" href='<?= Url::to(['/missions/review/index', 'sguid' => $space->guid]) ?>'>
                                    <?= Yii::t('MissionsModule.base', 'Review Evidence') ?>
                            </a>
                        </div>
                        <?php endif; ?>
                
                    </div>

                </div>
         </div>
    </div>
</div>

<?php else: ?>

<div class="panel panel-default">
    <div class="panel-body row">
        <div class="col-sm-6">
            <div class="panel-heading">
                <h4 class = "display-inline">
                    <strong>
                        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
                    </strong>
                </h4>
                
                <p style = "margin-top:10px">
                    <?= Yii::t('MissionsModule.base', 'Your average rating: {avg}', array('avg' => $avg)) ?>
                </p>
                
                <?php if($member): ?>
                    <a id="submit_evidence" class="btn btn-cta1" style="margin-top:5px" href="<?= Url::to(['/missions/evidence/missions', 'sguid' => $member->space->guid]); ?>">
                        <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
                    </a>
                <?php endif; ?>
                
            </div>
            <div class="panel-body">
               <p><?= Yii::t('MissionsModule.base', 'Every time you submit evidence, your overall rating will improve.') ?><p>
            </div>
        </div>
        <div class="col-sm-6">

            <div class = "grey_box row">
                
                <div class="col-xs-7 col-xs-7 col-sm-7">
                    <h6><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></h6>
                    <p style = "font-size:9pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>
                
                </div>
                            
                <div class="col-xs-5 col-xs-5 col-sm-5" style = "margin-top:10px">

                    <div style = "position:relative; text-align:center; float: left;">
                        <div class = "home-widget-evocoins">
                            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "70px">
                            <div style = "left: 1px; position:absolute; top: 20px; width: 100%;"><p><?= $wallet->amount ?></p></div>
                        </div>
                    </div>

                </div>
                
                <?php if($space): ?>
                    <div class = "text-center" style = "margin-top:100px; padding: 0 50px">
                        <a class = "btn btn-cta1" href='<?= Url::to(['/missions/review/index', 'sguid' => $space->guid]) ?>' style = "width: 100%; white-space:normal;">
                                <?= Yii::t('MissionsModule.base', 'Review Evidence') ?>
                        </a>
                    </div>
                <?php endif; ?>
                
            </div>

        </div>
    </div>
</div>

<?php endif; ?>

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