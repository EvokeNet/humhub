<?php

use yii\helpers\Html;
use humhub\modules\missions\models\Missions;
use app\modules\missions\models\Evidence;
use yii\widgets\Breadcrumbs;

$mission_title = isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title;

$this->title = $mission_title; //Yii::t('MissionsModule.base', 'Activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['missions', 'sguid' => $contentContainer->guid]];
// $this->params['breadcrumbs'][] = $mission->title;
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.model', 'Mission {position}', array('position' => $mission->position)); //Yii::t('MissionsModule.base', 'Mission {position} - {alias}', array('position' => $mission->position, 'alias' => $this->title)); //Yii::t('MissionsModule.base', 'Mission:').' '.$this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.page_titles', 'Mission {position} : {alias}', array('position' => $mission->position, 'alias' => $this->title));

$firstPrimary = true;
$firstSecondary = true;

?>

<ul class="nav nav-tabs nav-justified">
  <li style="text-transform: uppercase" class="<?php echo (Yii::$app->request->get('flag') && Yii::$app->request->get('flag') == 1) ? '' : 'active'; ?>"><a href="#tab-novel" data-toggle="tab"><?php echo Yii::t('MissionsModule.base', 'Introduction'); //Novel Chapter #{number}', array('number' => $mission->position)); ?></a></li>
  <li style="text-transform: uppercase" class="<?php echo (Yii::$app->request->get('flag') && Yii::$app->request->get('flag') == 1) ? 'active' : ''; ?>"><a href="#tab-mission" data-toggle="tab"><?php echo Yii::t('MissionsModule.base', 'Mission {position}', array('position' => $mission->position)); //$this->title; ?></a></li>
</ul>

<div class="tab-content clearfix">
    <div class="tab-pane <?php echo (Yii::$app->request->get('flag') && Yii::$app->request->get('flag') == 1) ? '' : 'active'; ?>" id="tab-novel">

    <!--<div>
        <?php if(!empty($previous_mission)): ?>
            <span><?php //echo Html::a(Yii::t('MissionsModule.base', '{icon} Previous', array('icon' => '<i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>')), ['activities', 'missionId' => $previous_mission->id, 'sguid' => $contentContainer->guid], array('style' => 'float:left')); ?></span>
        <?php else: ?>
            <span style="float:left"><?php echo Yii::t('MissionsModule.base', '{icon} Previous', array('icon' => '<i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>')); ?></span>
        <?php endif; ?>

        <?php if(!empty($next_mission)): ?>
            <span><?php //echo Html::a(Yii::t('MissionsModule.base', 'Next {icon}', array('icon' => '<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i>')), ['activities', 'missionId' => $next_mission->id, 'sguid' => $contentContainer->guid], array('style' => 'float:right')); ?></span>
        <?php else: ?>
            <span style="float:right"><?php //echo Yii::t('MissionsModule.base', 'Next {icon}', array('icon' => '<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i>')); ?></span>
        <?php endif; ?>
    </div>
    <br /><br />-->

        <?php if(!empty($pages)): ?>

        <div id="myCarousel" class="carousel">

          <!-- Indicators -->
          <!--<ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

            <?php foreach($pages as $key => $t): ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $key+1; ?>"></li>
            <?php endforeach; ?>

          </ol>-->

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">

                <div class="item active">
                  <!--<h6 style="background-color: #101C2A; text-align: center; padding: 10px 0; color: #5aa2c6;"><?php //echo Yii::t('MissionsModule.model', 'Chapter #{chapter} - Page #{page}', array('chapter' => $mission->position, 'page' => 1)); ?></h6>-->
                    <?php if($pages[0]->markup != ""): ?>
                        <?= $pages[0]->markup ?>
                    <?php else: ?>
                        <img src="<?php echo $pages[0]->page_image; ?>" alt="<?php echo $pages[0]->page_image; ?>" width="100%">
                  <?php endif; ?>
                </div>

                <?php unset($pages[0]); foreach ($pages as $key => $page): ?>

                    <?php if(isset($page->chapter->number)): ?>
                        <div class="item">
                          <!--<h6 style="background-color: #101C2A; text-align: center; padding: 10px 0; color: #5aa2c6;"><?php //echo Yii::t('MissionsModule.model', 'Chapter #{chapter} - Page #{page}', array('chapter' => $mission->position, 'page' => $key+1)); ?></h6>-->
                          <img src="<?= $page->page_image; ?>" alt="<?php echo $page->page_image; ?>" width="100%">
                        </div>

                    <?php endif; ?>

                <?php endforeach; ?>

          </div>

          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <?php endif; ?>

    </div>
    <div class="tab-pane <?php echo (Yii::$app->request->get('flag') && Yii::$app->request->get('flag') == 1) ? 'active' : ''; ?>" id="tab-mission">

        <!--<?php if(!empty($previous_mission)): ?>
        <span><?php //echo Html::a(Yii::t('MissionsModule.base', '{icon} Previous', array('icon' => '<i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>')), ['activities', 'missionId' => $previous_mission->id, 'sguid' => $contentContainer->guid, 'flag' => 1], array('style' => 'float:left')); ?></span>
        <?php else: ?>
            <span style="float:left"><?php //echo Yii::t('MissionsModule.base', '{icon} Previous', array('icon' => '<i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>')); ?></span>
        <?php endif; ?>

        <?php if(!empty($next_mission)): ?>
        <span><?php //echo Html::a(Yii::t('MissionsModule.base', 'Next {icon}', array('icon' => '<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i>')), ['activities', 'missionId' => $next_mission->id, 'sguid' => $contentContainer->guid, 'flag' => 1], array('style' => 'float:right')); ?></span>
        <?php else: ?>
            <span style="float:right"><?php //echo Yii::t('MissionsModule.base', 'Next {icon}', array('icon' => '<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i>')); ?></span>
        <?php endif; ?>

        <br /><br />-->

        <div class="panel panel-default">
            <div class="panel-heading">

                <h5>
                    <span class = "activity-number">
                            <?php echo $mission->position >= 1 ? $mission->position : "#" ?>
                    </span>
                    <span class="mission-title"><?= $mission_title ?></span>
                </h5>

            </div>
            <div class="panel-body">

                <p class="description">
                    <?= isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->description : $mission->description ?>
                </p>

                <br />

                <?php
                    $x = 0;
                    if (count($mission->activities) != 0): ?>

                    <?php foreach ($mission->activities as $key => $activity): $hasUserSubmittedEvidence = Evidence::hasUserSubmittedEvidence($activity->id);?>

                        <div class="panel panel-default">
                            <div class="panel-body panel-body grey-box">

                              <?php if ($activity->is_group): ?>
                                <span class="label label-border"><?php echo Yii::t('MissionsModule.model', 'Group Activity'); ?></span>
                              <?php endif; ?>

                                <h5 style = "line-height: 35px; padding-right: 30px;">

                                    <span class = "activity-number">
                                        <?php echo $activity->position >= 1 ?$activity->position : "#" ?>
                                    </span>
                                    <span class="mission-title"><?php echo isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?></span>
                                </h5>

                                <?php if($hasUserSubmittedEvidence): ?>
                                    <div style="position: absolute; top: 25px; right: 25px; color: #28C503;" data-toggle="tooltip" title="<?php echo Yii::t('MissionsModule.base', "You've completed this activity"); ?>"><i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i></div>
                                <?php endif; ?>

                                <br />
                                <p class="description">
                                    <?php echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?>
                                </p>

                                <div style="margin:30px 0 20px">

                                        <h6 style="margin-bottom:15px; font-size:12pt"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6>

                                        <div style="display: flex; flex-wrap: wrap;">
                                        <?php
                                            foreach($activity->getPrimaryPowers() as $power):
                                                if($firstPrimary)
                                                    $firstPrimary = false;

                                                $name = $power->getPower()->title;

                                                if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                                    $name = $power->getPower()->powerTranslations[0]->title;
                                        ?>

                                                <div class="power-cards">
                                                    <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                                                    <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '+{points} {power}', array('power' => $name, 'points' => $power->value)); ?></p>
                                                </div>
                                            
                                        <?php endforeach; ?>
                                        </div>

                                        <br />

                                        <h6 style="margin-bottom:15px; font-size:12pt"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6>
                                            <div style="display: flex; flex-wrap: wrap;">
                                                <?php
                                                    foreach($activity->getSecondaryPowers() as $power):
                                                        if($firstSecondary)
                                                            $firstSecondary = false;

                                                        $name = $power->getPower()->title;

                                                        if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                                            $name = $power->getPower()->powerTranslations[0]->title;
                                                ?>
                                                
                                                
                                                    <div class="power-cards">
                                                        <img src = "<?php echo $power->getPower()->image; ?>" width=40px>
                                                        <p style="font-size:9pt; margin-top:5px"><?php echo Yii::t('MissionsModule.base', '+{points} {power}', array('power' => $name, 'points' => $power->value)); ?></p>
                                                    </div>
                                                
                                                
                                                <?php endforeach; ?>
                                            </div>

                                </div>

                                    <br />

                                    <?php echo Html::a(
                                        Yii::t('MissionsModule.base', 'Enter Activity'),
                                        ['show', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], array('class' => 'btn btn-cta1', 'style' => 'float:right')); ?>

                                    <?php if(!$activity->is_group): ?>

                                      <?php $count = 0; foreach ($members as $membership) : $userSubmittedEvidence = Evidence::hasUserSubmittedEvidence($activity->id, $membership->user->id);?>
                                          <?php $user = $membership->user; ?>
                                          <?php if($membership->status === \humhub\modules\space\models\Membership::STATUS_MEMBER && $userSubmittedEvidence && $membership->user->id != Yii::$app->user->id) : $count++; ?>
                                              <a href=/content/perma/"<?php echo $user->getUrl(); ?>" style="margin-left:10px">
                                                  <img src="<?php echo $user->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin member-img" id = "space-members"
                                                      data-toggle="tooltip" data-placement="top" title=""
                                                      data-original-title="<?php echo Yii::t('MissionsModule.base', "{user} completed this activity", array('user' => Html::encode($user->displayName))); ?>">
                                              </a>
                                          <?php endif; ?>
                                      <?php endforeach; ?>
                                    <?php endif; ?>
                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php else: ?>
                    <p><?php echo Yii::t('MissionsModule.base', 'No activities created yet!'); ?></p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>    

<script>

$('.carousel-inner').each(function() {

    if ($(this).children('div').length === 1) $(this).siblings('.carousel-control, .carousel-indicators').hide();

});

</script>