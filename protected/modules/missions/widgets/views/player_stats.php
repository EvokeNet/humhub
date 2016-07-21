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
    <div class="panel-body">
        <div class = "evocoins">
            <img src="/humhub/themes/Evoke/img/evocoin_bg.png">
            <div><p><?= $wallet->amount ?></p></div>    
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Your Powers') ?></strong>
    </div>
    <div class="panel-body">
        <?php foreach($userPowers as $userQuality): ?>
            <div class="power text-center">
                <img src = "<?php echo $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->image; ?>" width="100px" class = "power-border"></img>
                
                <h6><?= $userQuality[0]->getPower()->getQualityPowersArray()[0]->getQualityObject()->name; ?></h6>
                
                <span class = "bold italic" style = "color: #28C503"><?php echo Yii::t('MissionsModule.base', 'Level {level}', array('level' => null != $userQuality[0]->getUserQuality() ? $userQuality[0]->getUserQuality()->getLevel() : 0)); ?></span>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style type="text/css">

.power{
    padding-bottom: 25px;
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