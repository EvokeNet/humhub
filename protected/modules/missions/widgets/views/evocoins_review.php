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

        <div class = "home-widget-evocoins" style = "margin: 10px 0 5px 30px;">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "120px">
            <div><p id="userEvocoins" style = "font-size:15pt"><?= $wallet->amount ?></p></div>
        </div>

        <br>

        <?php if($space): ?>
        <div style = "margin-top:20px">
            <a class = "btn btn-cta1" href='<?= Url::to(['/missions/review/index', 'sguid' => $space->guid]) ?>'>
                    <?php // Yii::t('MissionsModule.base', 'Review evidences') ?>
                    <?php
                    
                        $user = Yii::$app->user->getIdentity();

                        if($user->group->name == "Mentors"){
                            echo Yii::t('MissionsModule.base', 'Review Evidences');
                        } else{
                            echo Yii::t('MissionsModule.base', 'Tag Evidences');
                        }

                    ?>
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php else: ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Your Evocoins') ?>
    </div>
    <div class="panel-body text-center">
        <p style = "font-size:12pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>

        <div class = "home-widget-evocoins" style = "margin: 10px 0 5px 30px;">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>" width = "120px">
            <div><p id="userEvocoins" style = "font-size:15pt"><?= $wallet->amount ?></p></div>
        </div>

        <br>

        <?php if($space): ?>
        <div style = "margin-top:20px">
            <a class = "btn btn-cta1" href='<?= Url::to(['/missions/review/index', 'sguid' => $space->guid]) ?>'>
                <?php // Yii::t('MissionsModule.base', 'Review evidences') ?>
                <?php
                
                    $user = Yii::$app->user->getIdentity();

                    if($user->group->name == "Mentors"){
                        echo Yii::t('MissionsModule.base', 'Review Evidences');
                    } else{
                        echo Yii::t('MissionsModule.base', 'Tag Evidences');
                    }

                ?>
            </a>
        </div>
        <?php endif; ?>

    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
    </div>
    <div class="panel-body text-center">
        <h6><?= Yii::t('MissionsModule.base', 'Your average rating: {avg}', array('avg' => $avg)) ?></h6>

        <?php if($member): ?>
            <a id="submit_evidence" class="btn btn-cta1" style="margin: 5px 0 15px" href="<?= Url::to(['/missions/evidence/missions', 'sguid' => $member->space->guid]); ?>">
                <?php echo Yii::t('MissionsModule.base', 'Submit Evidence'); ?>
            </a>
        <?php endif; ?>

        <br />

        <p style = "font-size:10pt"><?= Yii::t('MissionsModule.base', 'Every time you submit evidence, your overall rating will improve.') ?><p>

    </div>
</div>

<?php endif; ?>
