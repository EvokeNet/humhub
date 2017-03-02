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
                <h6 style="text-align:center"><?php echo $m->title; ?></h6>
                <br />

                <table class="table table-responsive">
                    <thead>
                        <tr>
                        <th width="10"></th>
                        <?php foreach($a1 as $member): ?>
                            <th style="text-align:center">
                                <a href="<?php echo $member->getUrl(); ?>">
                                    <img src="<?php echo $member->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                                        style="width: 50px; height: 50px;" 
                                        data-original-title="<?php echo Html::encode($member->displayName); ?>">
                                </a>
                                <p style="margin-bottom: 0; margin-top: 5px; font-size:10pt"><?php echo $member->username; ?></p>
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
                                    <img src = "<?php echo $power->getPower()->image; ?>" width=50px>
                                    <span><?php echo Yii::t('MissionsModule.base', '+{points}', array('power' => $name, 'points' => $power->value)); ?></span>
                                    </th>
                                    
                                <?php endforeach; ?>

                                <?php foreach($a1 as $user): $status = Evidence::evidenceForActivityStatus($a->id, $user->id); ?>
                                    <td style="text-align:center">
                                    <div class="powers-box <?php echo $status; ?>">
                                        <?php echo Activities::getPrimaryPowerPoints($a->id, $user->id); ?>
                                    </div>
                                    </td>
                                <?php endforeach; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div style="margin:20px 0px 40px">
                <span style="display: inline-block; margin: 0 20px; font-weight: 700; color: #03ACC5;"><?php echo Yii::t('MissionsModule.base', 'Powers'); ?></span>
                <?php foreach($all_powers as $ap): ?>
                    <div style="display:inline-block; text-align:center; margin-right:20px">
                        <img src = "<?php echo $ap->image; ?>" width=40px>
                        <span style="font-size:9pt; margin-top:5px"><?php echo $ap->name; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<style>

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