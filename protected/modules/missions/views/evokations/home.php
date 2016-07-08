<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

$this->title = Yii::t('MissionsModule.base', 'Evokations');
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', "{name}'s Evokation Page", array('name' => $contentContainer->name));

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Evokations');

$total = 0;
$done = 0;

foreach($missions as $m):

    foreach($m->activities as $activity):
        $total++;
        foreach ($activity->evidences as $evidence):                     
            if($evidence->content->space_id == $contentContainer->id){ 
                $done++;    
                break;
            }
        endforeach;
    endforeach;
                                
endforeach;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        
        <a class = "btn btn-primary" href='<?= Url::to(['/missions/evokations/submit', 'sguid' => $contentContainer->guid]); ?>' style = "margin-top:10px">
            <?= Yii::t('MissionsModule.base', 'Submit evokation') ?>
        </a>
            
        <div style = "margin-top:10px; float:right">
            
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?= floor(($done/$total)*100) ?>%;">
                    <span class="sr-only"></span>
                </div>
            </div>
            <span><?= Yii::t('MissionsModule.base', 'Team Progress: {number}%', array('number' => floor(($done/$total)*100))) ?></span>
        </div>
        
        <h2><strong><?php echo Yii::t('MissionsModule.base', "{name}'s Evokation", array('name' => $contentContainer->name)); ?></strong></h2>

    </div>
    <div class="panel-body">
        
        
        <!--<div class="panel-group" role="tablist"> <div class="panel panel-default"> <div class="panel-heading" role="tab" id="collapseListGroupHeading1"> <h4 class="panel-title"> <a class="" role="button" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="true" aria-controls="collapseListGroup1"> Collapsible list group </a> </h4> </div> <div id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true"> <ul class="list-group"> <li class="list-group-item">Bootply</li> <li class="list-group-item">One itmus ac facilin</li> <li class="list-group-item">Second eros</li> </ul> <div class="panel-footer">Footer</div> </div> </div> </div>-->
        
        
        <?php 
        $x = 0;
        if (count($categories) != 0): 
        
        foreach ($categories as $category): $x++;?>

        <div class="panel-group" role="tablist"> 
            <div class="panel panel-default"> 
                
                <div class="panel-heading" role="tab" id="collapseListGroupHeading1"> 
                    <h4 class="panel-title"> 
                        <a class="" role="button" data-toggle="collapse" href="#collapseListGroup<?=$x?>" aria-expanded="true" aria-controls="collapseListGroup1"> 
                            <?= isset($category->evokationCategoryTranslations[0]) ? $category->evokationCategoryTranslations[0]->title : $category->title ?> 
                        </a> 
                    </h4> 
                </div> 
                
                <div id="collapseListGroup<?=$x?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true"> 
                    <ul class="list-group"> 
                        <?php foreach ($category->activities as $activity): 
                            if($activity->mission->locked == 0): ?>
                            <li class="list-group-item">
                                
                                <?php 
                                
                                $a = isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title;
                                //echo Html::a(
                                //$a,
                                //['evidences', 'activities', 'categoryId' => $mission->id, 'sguid' => $contentContainer->guid]); 
                                                                
                                echo Html::a($a, ['evidence/show', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], ['class' => 'profile-link']);
                                
                                $is_complete = false;
                                
                                foreach ($activity->evidences as $evidence):                     
                                    if($evidence->content->space_id==$contentContainer->id) 
                                        $is_complete = true;    
                                endforeach;
                                
                                if($is_complete): ?>      
                                    <span style = "float:left; margin-right:10px"><i class="fa fa-check-circle-o" aria-hidden="true"></i></span>                                
                                <?php else: ?>                                   
                                    <span style = "float:left; margin-right:10px"><i class="fa fa-circle-o" aria-hidden="true"></i></span>                          
                                <?php endif;  ?>
                                
                                <span class="label label-default" style = "margin-left:10px"><?= isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title ?></span> 
                                
                            </li>
                        <?php endif; endforeach; ?>
                        <!--<li class="list-group-item">Bootply</li> 
                        <li class="list-group-item">One itmus ac facilin</li> 
                        <li class="list-group-item">Second eros</li> -->
                    </ul> 
                    <!--<div class="panel-footer">Footer</div> -->
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
