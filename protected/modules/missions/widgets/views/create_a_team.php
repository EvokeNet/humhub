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
            <img src="<?php echo Url::to('@web/themes/Evoke/img/alchemy.png') ?>" width = "120px">
            <p class="uppercase" style = "font-weight:700"><?= Yii::t('MissionsModule.base', 'Team Captains') ?></p>
            <p>
                <span class="uppercase"><?= Yii::t('MissionsModule.base', 'Your first mission is') ?></span> 
                <a href="<?= Url::to(['/teams/create/create_team']) ?>" data-target = "#globalModal">
                    <?= Yii::t('MissionsModule.base', 'register your team on the platform.') ?>
                </a>
            </p>
            <p class="uppercase" style = "font-weight:700"><?= Yii::t('MissionsModule.base', 'Other Agents') ?></p>
            <p>
                <?= Yii::t('MissionsModule.base', 'Await the invitation from your captain to join your team.') ?>
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

</div>

<style>
.uppercase{
    text-transform: uppercase;
}
</style>