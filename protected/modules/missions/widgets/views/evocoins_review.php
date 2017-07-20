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
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Your Evocoins') ?>
    </div>
    <div class="panel-body text-center">
        <p style = "font-size:12pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>

        <div class = "home-widget-evocoins" style = "margin-left:30px">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "120px">
            <div><p id="userEvocoins" style = "font-size:15pt"><?= $wallet->amount ?></p></div>
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

<?php else: ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
    </div>
    <div class="panel-body text-center">

        <h6 style="margin-top:5px"><?= Yii::t('MissionsModule.base', 'Your average rating: {avg}', array('avg' => $avg)) ?></h6>

        <?php if(isset($current_mission)): ?>
            
            <?php if($member): ?>
                <p style = "font-size:10pt"><?= Yii::t('MissionsModule.base', "Post an evidence for the lastest unlocked mission<br> #{number} - {title}", array('number' => $current_mission['position'], 'title' => $current_mission['title'])); ?></p>
                
                <a id="submit_evidence" class="btn btn-cta1" style="margin-top:5px" href="<?= Url::to(['/missions/evidence/activities', 'missionId' => $current_mission['id'], 'sguid' => $member->space->guid]); ?>">
                    <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
                </a>
            <?php endif; ?>

        <?php endif; ?>

        <p style = "font-size:8pt; margin-top:10px"><?= Yii::t('MissionsModule.base', 'Everytime you submit an evidence, your overall rating will improve.') ?><p>

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Your Evocoins') ?>
    </div>
    <div class="panel-body text-center">
        <p style = "font-size:12pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>

        <div class = "home-widget-evocoins" style = "margin-left:30px">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "120px">
            <div><p id="userEvocoins" style = "font-size:15pt"><?= $wallet->amount ?></p></div>
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

<!-- <div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
    </div>
    <div class="panel-body text-center">
        <p><?= Yii::t('MissionsModule.base', "You're currently in Mission #{number} - {title}", array('number' => $current_mission['position'], 'title' => $current_mission['title'])); ?></p>

        <?php if($member): ?>
            <a id="submit_evidence" class="btn btn-cta1" style="margin-top:5px" href="<?= Url::to(['/missions/evidence/activities', 'missionId' => $current_mission['id'], 'sguid' => $member->space->guid]); ?>">
                <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
            </a>
        <?php endif; ?>

        <h6 style="margin-top:15px"><?= Yii::t('MissionsModule.base', 'Your average rating: {avg}', array('avg' => $avg)) ?></h6>

        <p style = "font-size:10pt"><?= Yii::t('MissionsModule.base', 'Every time you submit an evidence, your overall rating will improve.') ?><p>

    </div>
</div> -->

<!-- <div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
    </div>
    <div class="panel-body text-center">
        <h6><?= Yii::t('MissionsModule.base', 'Your average rating: {avg}', array('avg' => $avg)) ?></h6>

        <?php if($member): ?>
            <a id="submit_evidence" class="btn btn-cta1" style="margin-top:5px" href="<?= Url::to(['/missions/evidence/missions', 'sguid' => $member->space->guid]); ?>">
                <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
            </a>
        <?php endif; ?>

        <p style = "font-size:10pt"><?= Yii::t('MissionsModule.base', 'Every time you submit evidence, your overall rating will improve.') ?><p>

    </div>
</div> -->

<?php endif; ?>
