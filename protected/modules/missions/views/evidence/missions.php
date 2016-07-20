<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Missions');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Missions');

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2><strong><?php echo Yii::t('MissionsModule.base', 'Missions'); ?></strong></h2>
    </div>
    <div class="panel-body">

        <?php 
            $x = 0;
            if (count($missions) != 0): ?>
            
            <?php foreach ($missions as $mission): ?>
            
                <div class="panel panel-default">
                    <div class="panel-body grey_box">
                        
                        <h4>
                            <strong><?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title ?></strong>
                        </h4>
                        
                        <p class="description">
                            <?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->description : $mission->description ?>
                        </p>
                        
                        <br>
                        <?php echo Html::a(
                            Yii::t('MissionsModule.base', 'Enter Mission'),
                            ['activities', 'missionId' => $mission->id, 'sguid' => $contentContainer->guid], array('class' => 'btn btn-cta1')); ?>
                    </div>
                </div>
                
            <?php endforeach; ?>
            
        <?php else: ?>
            <p><?php echo Yii::t('MissionsModule.base', 'No missions created yet!'); ?></p>
        <?php endif; ?>
    </div>
</div>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
