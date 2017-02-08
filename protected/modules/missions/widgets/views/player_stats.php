<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\coin\models\Wallet;

$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></strong>
    </div>
    <div class="panel-body text-center">
        <div class = "evocoins">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>">
            <div><p><?= $wallet->amount ?></p></div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Your Powers') ?></strong>
    </div>
    <div class="panel-body">
        <?php foreach($userPowers as $userQuality): $quality = $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject(); 
            $name = $quality->name;
            
            if(Yii::$app->language == 'es' && isset($quality->qualityTranslations[0]))
                $name = $quality->qualityTranslations[0]->name;
        ?>
        <?php
            $unavailable_power = $userQuality[0]->getUserQuality() == null || $userQuality[0]->getUserQuality()->getLevel() <= 0 ? true : false;
        ?>
            <div class="player-power text-center">
                <img src = "<?php echo $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->image; ?>" width="100px" class = "power-border"></img>
                <br />
                <span class="text-header"><?= $name ?></span><br />
                <span class="text-content"><?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => null != $userQuality[0]->getUserQuality() ? $userQuality[0]->getUserQuality()->getLevel() : 0)); ?></span>

            </div>
        <?php endforeach; ?>
    </div>
</div>
