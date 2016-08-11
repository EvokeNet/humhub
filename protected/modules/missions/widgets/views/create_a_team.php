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
            <!--English-->
            <b class="uppercase">Team captains</b>
            <p>
                Your first mission is 
                <a href="<?= Url::to(['/teams/create/create_team']) ?>" data-target = "#globalModal">
                    register your team on the platform.
                </a>
            </p>
            <b class="uppercase">Other agents</b>
            <p>
                Await the invitation from your captain to join your team.
            </p>

            <!--Spanish-->
            <b class="uppercase">Agentes capitanes:</b> 
            <p>
                Su primera misión es registrar el
                <a href="<?= Url::to(['/teams/create/create_team']) ?>" data-target = "#globalModal">
                    equipo en la plataforma.
                </a>
            </p>
            <b class="uppercase">Los demás agentes</b>
            <p>
                Deben unirse cuando reciban la invitación de su capitán.
            </p>
        </div>
    </div>

    <HR>

    <div class="panel-body">
        <a class = "btn btn-cta2" href="<?= Url::to(['/teams/create/create_team']) ?>" data-target = "#globalModal" style = "width:90px">
            <?= Yii::t('MissionsModule.base', 'Create') ?>
        </a>
    </div>

</div>

<style>
.uppercase{
    text-transform: uppercase;
}
</style>