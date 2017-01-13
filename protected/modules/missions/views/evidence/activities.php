<?php

use yii\helpers\Html;
use humhub\modules\missions\models\Missions;
use app\modules\missions\models\Evidence;
use yii\widgets\Breadcrumbs;

$mission_title = isset($mission->missionTranslations[0]) ? $mission->missionTranslations[0]->title : $mission->title;

$this->title = $mission_title; //Yii::t('MissionsModule.base', 'Activities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Missions'), 'url' => ['missions', 'sguid' => $contentContainer->guid]];
// $this->params['breadcrumbs'][] = $mission->title;
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Mission {position} - {alias}', array('position' => $mission->position, 'alias' => $this->title)); //Yii::t('MissionsModule.base', 'Mission:').' '.$this->title;

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Mission {position} - {alias}', array('position' => $mission->position, 'alias' => $this->title));

$firstPrimary = true;
$firstSecondary = true;

?>

<ul class="nav nav-tabs nav-justified">
  <li class="active"><a href="#tab-novel" data-toggle="tab"><?php echo Yii::t('MissionsModule.model', 'Novel Chapter #{number}', array('number' => $mission->position)); ?></a></li>
  <li><a href="#tab-mission" data-toggle="tab"><?php echo Yii::t('MissionsModule.base', 'Mission {position} - {alias}', array('position' => $mission->position, 'alias' => $this->title)); ?></a></li>
</ul>

<div class="tab-content clearfix">
    <div class="tab-pane active" id="tab-novel">

        <?php if(!empty($previous_mission)): ?>
        <span><?php echo Html::a(
            Yii::t('MissionsModule.base', '{icon} Previous Chapter', array('icon' => '<i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>')),
            ['activities', 'missionId' => $previous_mission->id, 'sguid' => $contentContainer->guid], array('style' => 'float:left')); ?></span>
        <?php else: ?>
            <span><?php echo Yii::t('MissionsModule.base', '{icon} Previous Chapter', array('icon' => '<i class="fa fa-arrow-circle-o-left fa-lg" aria-hidden="true"></i>')); ?></span>
        <?php endif; ?>

        <?php if(!empty($next_mission)): ?>
        <span><?php echo Html::a(
            Yii::t('MissionsModule.base', 'Next Chapter {icon}', array('icon' => '<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i>')),
            ['activities', 'missionId' => $next_mission->id, 'sguid' => $contentContainer->guid], array('style' => 'float:right')); ?></span>
        <?php else: ?>
            <span><?php echo Yii::t('MissionsModule.base', '{icon} Previous Chapter', array('icon' => '<i class="fa fa-arrow-circle-o-right fa-lg" aria-hidden="true"></i>')); ?></span>
        <?php endif; ?>
        <?php if(!empty($pages)): ?>

        <div id="myCarousel" class="carousel">

          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

            <?php foreach($pages as $key => $t): ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $key+1; ?>"></li>
            <?php endforeach; ?>

          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">

                <div class="item active">
                  <h6 style="background-color: white; text-align: center; padding: 10px 0;"><?php echo Yii::t('MissionsModule.model', 'Chapter #{chapter} - Page #{page}', array('chapter' => $mission->position, 'page' => 1)); ?></h6>
                  <img src="<?php echo $pages[0]->page_image; ?>" alt="?php echo $pages[0]->page_image; ?" width="100%">
                </div>

                <?php unset($pages[0]); foreach ($pages as $key => $page): ?>

                    <?php if(isset($page->chapter->number)): ?>
                        <div class="item">
                          <h6 style="background-color: white; text-align: center; padding: 10px 0;"><?php echo Yii::t('MissionsModule.model', 'Chapter #{chapter} - Page #{page}', array('chapter' => $mission->position, 'page' => $key+1)); ?></h6>
                          <img src="<?php echo $page->page_image; ?>" alt="<?php echo $page->page_image; ?>" width="100%">
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
    <div class="tab-pane" id="tab-mission">

        <div class="panel panel-default">
            <div class="panel-heading">
         
                <!-- <span class = "mission-number"><?= $mission->position ?></span> -->

                <h5 style="display: inline-block; font-weight:700">
                    <?php echo Yii::t('MissionsModule.base', 'Mission {position}: {title}', array('position' => $mission->position, 'title' => $mission_title)); ?>
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
                                    <?php echo isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title ?>
                                </h5>

                                <?php if($hasUserSubmittedEvidence): ?>
                                    <div style="position: absolute; top: 25px; right: 25px; color: #28C503;" data-toggle="tooltip" title="<?php echo Yii::t('MissionsModule.base', "You've completed this activity"); ?>"><i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i></div>
                                <?php endif; ?>

                                <br />
                                <p class="description">
                                    <?php echo nl2br(isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->description : $activity->description) ?>
                                </p>

                                    <br />
                                    <div class="row" style="margin-bottom:20px">
                                        <div class="col-xs-4"><h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Primary Power') ?></h6></div>
                                        <div class="col-xs-8">

                                            <?php
                                                foreach($activity->getPrimaryPowers() as $power):
                                                    if($firstPrimary)
                                                        $firstPrimary = false;

                                                    $name = $power->getPower()->title;

                                                    if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                                        $name = $power->getPower()->powerTranslations[0]->title;
                                            ?>


                                                <div style="text-align: center; display:inline-block">
                                                <img src = "<?php echo $power->getPower()->image; ?>" width=50px>
                                                <span style="font-size:10pt"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></span>
                                            </div>

                                            <?php endforeach; ?>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4"><h6 style = "margin-bottom:15px"><?= Yii::t('MissionsModule.base', 'Secondary Power(s)') ?></h6></div>
                                        <div class="col-xs-8">

                                            <?php
                                                foreach($activity->getSecondaryPowers() as $power):
                                                    if($firstSecondary)
                                                        $firstSecondary = false;

                                                    $name = $power->getPower()->title;

                                                    if(Yii::$app->language == 'es' && isset($power->getPower()->powerTranslations[0]))
                                                        $name = $power->getPower()->powerTranslations[0]->title;
                                            ?>

                                            <div style="text-align: center; display:inline-block; margin-bottom:10px">
                                                <img src = "<?php echo $power->getPower()->image; ?>" width=50px>
                                                <span style="font-size:10pt"><?php echo Yii::t('MissionsModule.base', '{power} - {points} point(s)', array('power' => $name, 'points' => $power->value)); ?></span>
                                            </div>

                                        <?php endforeach; ?>

                                    </div>
                                </div>

                                    <br />

                                    <?php echo Html::a(
                                        Yii::t('MissionsModule.base', 'Enter Activity'),
                                        ['show', 'activityId' => $activity->id, 'sguid' => $contentContainer->guid], array('class' => 'btn btn-cta2')); ?>

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