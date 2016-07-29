<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'Create new team') ?>
        </strong>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <!-- content -->
        </div>
    </div>

    <HR>

    <div class="panel-body">
        <a class = "btn btn-cta2" href="<?= Url::to(['/teams/create/create_team']) ?>" data-target = "#globalModal" style = "width:90px">
            <?= Yii::t('MissionsModule.base', 'Create') ?>
        </a>
    </div>

</div>