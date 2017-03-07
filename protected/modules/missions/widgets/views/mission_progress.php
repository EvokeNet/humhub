<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Activities;
use app\modules\missions\models\Evidence;

?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
        </strong>
    </div>
    <div class="panel-body">

        <div style="margin:20px 0px 40px">
                <div style="margin-bottom:30px">
                    <div style="text-align: center; display: inline-table; margin-right:20px">
                        <div class="powers-box empty" style="margin-bottom:5px; height: 40px; min-width: 40px;">
                        
                        </div><br />
                        <span style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', 'Evidence Not Submitted'); ?></span>
                    </div>

                    <div style="text-align: center; display: inline-table; margin-right:20px">
                        <div class="powers-box vote_ally" style="margin-bottom:5px; height: 40px; min-width: 40px;">
                        
                        </div><br />
                        <span style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', 'Reviewed by Ally'); ?></span>
                    </div>

                    <div style="text-align: center; display: inline-table; margin-right:20px">
                        <div class="powers-box vote_mentor" style="margin-bottom:5px; height: 40px; min-width: 40px;">
                    
                        </div><br />
                        <span style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', 'Reviewed by Mentor'); ?></span>
                    </div>

                    <div style="text-align: center; display: inline-table; margin-right:20px">
                        <div class="powers-box both" style="margin-bottom:5px; height: 40px; min-width: 40px;">
                            
                        </div><br />
                        <span style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', 'Reviewed by Both'); ?></span>
                    </div>
                </div>

            </div>

        <?php foreach($missions as $m): $all_powers = array(); ?>
            <div class="review-box">

                <h5 style="text-align:center"><?php echo Yii::t('MissionsModule.base', 'Mission {position}', array('position' => $m->position)); ?></h5>
                <h6 style="text-align:center">
                    <?php 
                            if(Yii::$app->language == 'es' && isset($m->missionTranslations[0]))
                                echo $m->missionTranslations[0]->title;
                            else
                                echo $m->title;
                    ?>
                </h6>
                <br />

                <table class="table table-responsive">
                    <thead>
                        <tr>
                        <th width="10"></th>
                        <?php foreach($a1 as $member): ?>
                            <th width="20" style="text-align:center">
                                <a href="<?php echo $member->getUrl(); ?>">
                                    <img src="<?php echo $member->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                                        style="width: 50px; height: 50px;" 
                                        data-original-title="<?php echo Html::encode($member->displayName); ?>">
                                    <p style="margin-bottom: 0; margin-top: 5px; font-size:10pt"><?php echo $member->name; ?></p>
                                </a>
                            </th>
                        <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($m->activities as $a): ?>
                            <tr>

                                <?php
                                    foreach($a->getPrimaryPowers() as $power):

                                        //array_push($all_powers, $power->getPower());

                                        if(empty($all_powers[$power->getPower()->id]))
                                            $all_powers[$power->getPower()->id] = $power->getPower();

                                        $name = $power->getPower()->title;  

                                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                            $name = $power->getPower()->powerTranslations[0]->title;
                                ?>
                                    <th style="text-align:center">
                                    <a href="<?= $contentContainer->createUrl('/missions/evidence/show', ['activityId' => $a->id]) ?>">
                                        <img src = "<?php echo $power->getPower()->image; ?>" width=50px>
                                        <span style='display: inline-flex'>
                                            <?php echo Yii::t('MissionsModule.base', '+{points}', array('power' => $name, 'points' => $power->value)); ?> 
                                            <br>
                                            <?php echo $a->is_group ? Yii::t('MissionsModule.base', 'Group') : '' ?>
                                        </span>
                                    </a> 
                                    </th>
                                    
                                <?php endforeach; ?>

                                <?php foreach($a1 as $user): $status = Evidence::evidenceForActivityStatus($a->id, $user->id); ?>
                                    <?php 
                                        $evidence = Evidence::getUserEvidence($user->id, $a->id); 
                                        $url = $evidence ? $contentContainer->createUrl('/space/space', ['wallEntryId' => $evidence->content->getFirstWallEntryId()]) : '';
                                        $class = $evidence ? '' : 'disabled';
                                    ?>
                                    <td style="text-align:center">
                                    <a class="<?=$class ?>" href="<?php echo $url ?>">
                                        <div class="powers-box <?php echo $status; ?>">
                                            <?php echo Activities::getPrimaryPowerPoints($a->id, $user->id); ?>
                                        </div>
                                    </a>
                                    </td>
                                <?php endforeach; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div style="margin:40px 0px 5px">
                    <span style="display: inline-block; margin-bottom: 10px; font-weight: 700; color: #03ACC5; font-size: 12pt;"><?php echo Yii::t('MissionsModule.base', 'Powers'); ?></span>

                        <?php $counter = 0 ?>
                        <?php foreach($all_powers as $ap): ?>
                            <?php 
                                if($counter%3==0){
                                    echo "<div class='row'>"; 
                                }
                            ?>
                                <div class="col-sm-4">
                                    <img src = "<?php echo $ap->image; ?>" width=40px>
                                    <p style="font-size:9pt; margin-top:5px; display:inline"><?php echo $ap->getName(); ?></p>
                                    <p style="font-size:9pt; margin-top:5px;"><?php echo $ap->getDescription(); ?></p>
                                </div>
                            <?php 
                                if($counter%3==2 || $counter == sizeof($all_powers)-1){
                                    echo "</div>"; 
                                }
                                $counter++;
                            ?>
                        <?php endforeach; ?>
        
                </div>

            </div>

        <?php endforeach; ?>

    </div>
</div>

<style>


.disabled {
       pointer-events: none;
       cursor: default;
    }
    .powers-box{
        text-align: center;
        display: inline-block;
        font-size: 9pt;
        font-weight: 700;
        /* padding: 5px 10px; */
        height: 50px;
        line-height: 52px;
        /* width: 140px; */
        min-width: 50px;
        /* min-height: 105px; */
        /*border: 3px solid #03ACC5;*/
        /*margin-bottom: 20px;*/
        background-color: #03ACC5;
        border-radius: 50%;
        color: white;
    }

    .empty{
        /*display: none;*/
        border: 3px solid #03ACC5;
        background-color: transparent;
        line-height: 47px;
        color: transparent;
    }

    .submit{
        border:none;
        line-height: 52px;
    }

    .vote_ally{
        border: 3px solid white;
        line-height: 47px;
    }

    .vote_mentor{
        border: 5px double white;
        line-height: 42px;
    }

    .both{
        border: 5px solid white;
        line-height: 42px;
    }

</style>