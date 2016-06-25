<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><?= Yii::t('MissionsModule.base', 'Mission Progress') ?></strong>
    </div>
    <div class="list-group submit-body">
    	<div class= "list-group-item">
    		Evocoins
        </div>
    </div>
</div>

<style type="text/css">

.unavailable{
    color: white;
    text-shadow: -0.5px 0 gray, 0 0.5px gray, 2px 0 gray, 0 -0.5px gray;
}

.unavailable:hover{
    color: white;
}

</style>