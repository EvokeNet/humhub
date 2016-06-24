<?php

use yii\helpers\Html;
use app\modules\missions\models\Missions;
use yii\widgets\Breadcrumbs;

$this->title = Yii::t('MissionsModule.base', 'Evokations');
$this->params['breadcrumbs'][] = $this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Evokations');

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2><strong><?php echo Yii::t('MissionsModule.base', 'Evokations'); ?></strong></h2>
    </div>
    <div class="panel-body">
        
        
        <!--<div class="panel-group" role="tablist"> <div class="panel panel-default"> <div class="panel-heading" role="tab" id="collapseListGroupHeading1"> <h4 class="panel-title"> <a class="" role="button" data-toggle="collapse" href="#collapseListGroup1" aria-expanded="true" aria-controls="collapseListGroup1"> Collapsible list group </a> </h4> </div> <div id="collapseListGroup1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="collapseListGroupHeading1" aria-expanded="true"> <ul class="list-group"> <li class="list-group-item">Bootply</li> <li class="list-group-item">One itmus ac facilin</li> <li class="list-group-item">Second eros</li> </ul> <div class="panel-footer">Footer</div> </div> </div> </div>-->
        
        
        <?php 
        $x = 0;
        if (count($missions) != 0): ?>
        
        <?php foreach ($missions as $mission): $x++;?>
                
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
                        <?php foreach ($mission->activities as $activity): ?>
                            <li class="list-group-item">
                                
                                <?php 
                                
                                $a = isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title;
                                //echo Html::a(
                                //$a,
                                //['evidences', 'activities', 'missionId' => $mission->id, 'sguid' => $contentContainer->guid]); 
                                                                
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
                                
                                <span class="label label-default" style = "margin-left:10px"><?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title ?></span> 
                                
                            </li>
                        <?php endforeach; ?>
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
                    <p><?php echo Yii::t('MissionsModule.base', 'No missions created yet!'); ?></p>
                <?php endif; ?>
        
    </div>
</div>

<style type="text/css">

.description{
    text-align: justify;
}

</style>
