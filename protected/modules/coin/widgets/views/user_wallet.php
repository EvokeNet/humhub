<?php

use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Your Evocoins') ?></strong>
    </div>
    <div class="panel-body text-center">
        <div class = "evocoins">
            <img src="<?php echo Url::to('@web/themes/Evoke/img/evocoin_bg.png') ?>">
            <div><p id="userEvocoins"><?= $amount ?></p></div>
        </div>
        <br>
        <p style = "font-size:9pt"><?= Yii::t('MissionsModule.base', 'Earn Evocoins by reviewing evidence.') ?></p>
    </div>
</div>
