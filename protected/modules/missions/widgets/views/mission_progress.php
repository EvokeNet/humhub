<?php

// use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\missions\models\Evidence;

?>

<div class="panel panel-default portfolio">
    <div class="panel-heading">
        <strong>
            <?= Yii::t('MissionsModule.base', 'Mission Progress') ?>
        </strong>
    </div>
    <div class="panel-body">
        <?php //foreach($members_team as $mt): var_dump($mt)?>
            <?php //echo $mt->user->name; ?>
            <?php //echo $mt->evidence->title; ?>
        <?php //endforeach; ?>

        <?php foreach($missions as $m): ?>
            <div class="review-box">
                <h5 style="text-align:center"><?php echo Yii::t('MissionsModule.base', 'Mission {position}', array('position' => $m->position)); ?></h5>
                <h6 style="text-align:center"><?php echo $m->title; ?></h6>
                <br /><br />

                <div style="display:flex">
                    <div style="min-width:70px">A</div>
                    <?php foreach($a1 as $member): ?>
                        <div style="display:inline-block; min-width:100px; text-align:center">
                            <a href="<?php echo $member->getUrl(); ?>">
                                <img src="<?php echo $member->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                                    style="width: 50px; height: 50px;" 
                                    data-original-title="<?php echo Html::encode($member->displayName); ?>">
                            </a>
                            <!-- <span style="display:inline-block; min-width:100px; text-align:center"><?php echo $member->username; ?></span> -->
                            <br />
                            <span><?php echo $member->username; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <br /><br />

                <?php foreach($m->activities as $a): ?>
                    <div style="display:flex; border-bottom: 1px dotted white; margin-bottom: 20px;">
                        <div style="min-width:30px; line-height:55px;">A<?php echo $a->position; ?><br />
                            <?php $pp = $a->getPrimaryPowers(); $power = $pp[0]->getPower(); ?>
                        </div>
                        
                        <?php
                            foreach($a->getPrimaryPowers() as $power):

                                $name = $power->getPower()->title;

                                if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                    $name = $power->getPower()->powerTranslations[0]->title;
                        ?>

                                <div style="text-align:center">
                                    <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                                    <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '+{points}', array('power' => $name, 'points' => $power->value)); ?></p>
                                </div>
                            
                        <?php endforeach; ?>

                        
                        <!-- <div style="margin-left:0px; display: inherit;"> -->
                        <?php foreach($a1 as $user): $status = Evidence::evidenceForActivityStatus($a->id, $user->id); ?>
                            <div style="min-width: 100px; text-align: center;">
                                <div class="powers-box <?php echo $status; ?>">
                                    100
                                </div>
                            </div>
                        <?php endforeach; ?><br />
                        <!-- </div> -->

                    </div>
                <?php endforeach; ?>

            </div>
            
        <?php endforeach; ?>


        <!--<?php foreach($missions as $m): ?>
            <div class="review-box">
                <h5><?php echo $m->title; ?></h5>
                <br /><br />
                
                <div>
                    <?php foreach($members as $member): ?>
                        <a href="<?php echo $member->user->getUrl(); ?>">
                            <img src="<?php echo $member->user->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                                height="24" width="24" alt="24x24" data-src="holder.js/24x24"
                                style="width: 50px; height: 50px;" data-toggle="tooltip" data-placement="top" title=""
                                data-original-title="<?php echo Html::encode($member->user->displayName); ?>">
                        </a>
                        <span><?php echo $member->user->name; ?></span>
                    <?php endforeach; ?>    
                </div>
                
                <br /><br />

                <?php foreach($m->activities as $a): ?>
                    A<?php echo $a->position; ?><br />
                   
                    <?php //foreach($a->evidences as $e): ?>
                        <?php //echo $e->title; ?><br />
                    <?php //endforeach; ?>

                <?php endforeach; ?>

            </div>
            
        <?php endforeach; ?>-->

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
        margin-bottom: 20px;
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
    }

</style>