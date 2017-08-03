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
            <div class="player-power text-center" style="margin-bottom:10px">
                <div style="float:left"><img src = "<?php echo $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->image; ?>" width="70px" class = "power-border"></img></div><br>

                <div>
                    <span class = "bold" style = "color: #03ACC5; margin-top:10px; display:block"><?= $name ?></span>
                    <span class = "bold" style = "color: #A6AAB2; margin-top:5px; display:block; font-size:10pt"><?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => null != $userQuality[0]->getUserQuality() ? $userQuality[0]->getUserQuality()->getLevel() : 0)); ?></span>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>