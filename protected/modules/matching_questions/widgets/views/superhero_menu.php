<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('app', 'Superhero Identity') ?>
        </strong>
    </div>
    <div class="list-group submit-body">
	    <div class="list-group-item">
            <?= isset($superhero_id->name) ? $superhero_id->name : Yii::t('app', 'Not Defined Yet'); ?>
	    </div>
    </div>
</div>