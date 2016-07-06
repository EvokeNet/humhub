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
    <div class="list-group submit-body">
    	<div class= "list-group-item" style="font-size: 30px;">
            <?= $wallet->amount ?>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Your Powers') ?></strong>
    </div>
    <div class="list-group submit-body">
        <div class= "list-group-item">
            <?php foreach($userPowers as $userQuality): ?>
                <div class="power" style="font-size: 18px;">
                    <i class="fa fa-eye fa-5x" aria-hidden="true" style="font-size: 40px;"></i>
                    <BR>
                    <strong>
                        <?= $userQuality[0]->getPower()->getQualityPowers()[0]->getQualityObject()->name; ?>
                    </strong>
                    <BR>
                    <div class="level" style="font-size: 14px;">
                        Level <?= $userQuality[0]->getUserQuality()->getLevel() ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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