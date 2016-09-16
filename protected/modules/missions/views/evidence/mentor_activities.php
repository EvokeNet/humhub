<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\missions\models\Evokations;

$this->title = Yii::t('MissionsModule.base', 'Evokations');
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', "Activities");

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', "{name}'s Evokation", array('name' => $contentContainer->name));

?>

<div class="panel panel-default">
    <div class="panel-heading">
        
        <h2><strong><?php echo Yii::t('MissionsModule.base', "Activities"); ?></strong></h2>

    </div>
    <div class="panel-body">
        
        <b><?php echo Yii::t('MissionsModule.base', "Choose an Activity:"); ?></b>

        <br><br>

        <?php 
        $x = 0;
        if (count($missions) != 0): 
        
        foreach ($missions as $mission): $x++;?>

        <div class="panel-group" role="tablist"> 
            <div class="panel panel-default"> 
                
                <div class="panel-heading" role="tab" id="collapseListGroupHeading1"> 
                    <h4 class="panel-title"> 
                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup<?=$x?>" aria-expanded="true" aria-controls="collapseListGroup1"> 
                            <?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title ?> 
                        </a> 
                    </h4> 
                </div> 
                
                <div id="collapseListGroup<?=$x?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true"> 
                    <ul class="list-group"> 
                        <?php foreach ($mission->activities as $activity):  ?>
                            <li class="list-group-item">
                                
                                <?php 
                                $a = isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title;
                                echo Html::a($a, ['evidence/mentor', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], ['class' => 'profile-link']);
                                ?>
                                
                                <span class="label label-default" style = "margin-left:10px"><?= isset($activity->evokationCategory->evokationCategoryTranslations[0]) ? $activity->evokationCategory->evokationCategoryTranslations[0]->title : $activity->evokationCategory->title ?></span> 
                                
                            </li>
                        <?php endforeach; ?>

                    </ul> 
                </div>
                
             </div>
        </div>
        
        <?php endforeach; ?>
            
            <?php else: ?>
                <p><?php echo Yii::t('MissionsModule.base', 'No categories created yet!'); ?></p>
            <?php endif; ?>
        
    </div>
</div>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
