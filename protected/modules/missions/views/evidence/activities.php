<?php

use yii\helpers\Html;
use humhub\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = $mission->title; //Yii::t('MissionsModule.base', 'Activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['missions', 'sguid' => $contentContainer->guid]];
// $this->params['breadcrumbs'][] = $mission->title;
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission {position} - {alias}', array('position' => $mission->position, 'alias' => $this->title)); //Yii::t('MissionsModule.base', 'Mission:').' '.$this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$mission_title = isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title;

$this->pageTitle = Yii::t('MissionsModule.base', 'Mission {mission}: Activities', array('mission' => $mission_title));

$firstPrimary = true;
$firstSecondary = true;

?>
<div class="panel panel-default">
    <div class="panel-heading">

        <h3 class = "bold"><span class = "mission-number"><?= $mission->position ?></span><?php echo Yii::t('MissionsModule.base', 'Mission:'); ?>&nbsp;<?= $mission_title ?></h3>
        <br />
        <p class="description">
            <?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->description : $mission->description ?>
        </p>

    </div>
    <div class="panel-body">

        <?php
            $x = 0;
            if (count($mission->activities) != 0): ?>

            <?php foreach ($mission->activities as $key => $activity): ?>

                <div class="panel panel-default">
                    <div class="panel-body panel-body grey-box">

                        <h5><span class = "activity-number"><?= $activity->position ?></span><?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?></h5>
                        <br />
                        <p class="description">
                            <?= isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description ?>
                        </p>

                        <br>
                        <?php echo Html::a(
                                Yii::t('MissionsModule.base', 'Enter Activity'),
                                ['show', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], array('class' => 'btn btn-cta2')); ?>

                        <div class="row" style = "margin-top:20px">
                            <div class="col-xs-5 text-center">
                                <h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6>

                                <?php
                                    foreach($activity->getPrimaryPowers() as $power):
                                        if($firstPrimary)
                                            $firstPrimary = false;
                                ?>

                                <img src = "<?php echo $power->getPower()->image; ?>" width=70px style = "margin-bottom:10px">
                                <p><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $power->getPower()->title, 'points' => $power->value)); ?></p>
                                <br />

                                <?php endforeach; ?>

                           </div>
                            <div class="col-xs-7 text-center">
                                <h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6>

                                <?php
                                    foreach($activity->getSecondaryPowers() as $power):
                                        if($firstSecondary)
                                            $firstSecondary = false;
                                ?>

                                <img src = "<?php echo $power->getPower()->image; ?>" width=70px style = "margin-bottom:15px">
                                <p><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $power->getPower()->title, 'points' => $power->value)); ?></p>
                                <br />
                                <?php endforeach; ?>

                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        <?php else: ?>
            <p><?php echo Yii::t('MissionsModule.base', 'No activities created yet!'); ?></p>
        <?php endif; ?>
    </div>
</div>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
