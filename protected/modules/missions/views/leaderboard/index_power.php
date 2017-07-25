<?php

use yii\helpers\Html;

    // echo "<pre>";
    // print_r($ranking);
    // echo "</pre>";

$this->pageTitle = Yii::t('MissionsModule.base', 'Leaderboard');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4><?= Yii::t('MissionsModule.base', 'Leaderboard') ?></h4>
                </div>

                <div class="panel-body">

                    <div class="row" style="text-align:center; margin:15px 0 45px">
                        <div class="col-sm-6">
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'GENERAL RANKINGS'), ['/missions/leaderboard/index'], ['class' => 'ranking', 'style' => '']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'POWERS RANKING'), ['/missions/leaderboard/powers'], ['class' => 'ranking current_tab', 'style' => '']) ?>                            
                        </div>
                    </div>

                    <div class="row" style="margin-right: 50px">
                        <div class="col-md-2 col-md-offset-5">
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                <?php echo Yii::t('MissionsModule.leaderboard', "SELECT POWER"); ?>
                                <span class="caret"></span>
                              </button>

                              <ul class="dropdown-menu" style="background-color:#101C2A;">
                                <?php foreach($powers as $power): ?>
                                    <li><?= Html::a($power->title, ['/missions/leaderboard/powers', 'id' => $power->id], ['class' => 'ranking', 'style' => '']) ?> </li>
                                <?php endforeach; ?>
                              </ul>
                            </div>
                        </div>
                    </div>

                    <br>

                    <!-- Top Power Agents -->
                    <?php $user = Yii::$app->user->getIdentity(); ?>
                    <?php if($user->group->name != "Mentors"): ?>
                    <div class="leaderboard-box" style="padding:0; margin-bottom:60px">
                        <div style="text-align:center; background-color:#0F2441; padding:10px">
                            <h5 style="color:#FEAE1B; text-transform:uppercase;">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Agents By {title}', array('title' => $powers[$id-1]['title'])) ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row" style="padding:20px 20px 0">
                            <?php foreach($ranking as $key => $r): ?>
                                <div class="col-sm-6">
                                    <div style = "padding: 10px; margin-bottom: 15px; border: 2px solid #5aa2c6;">

                                        <div class="row">
                                            <div class="col-sm-10" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                                <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                                <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']) ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="l-number"><?php echo $r['value']; ?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <br />
                        <?php if (Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
                            <?php if($ranking['my_reviews']['position'] == -1): ?>
                                <span style = "font-weight: 700; color: #5aa2c6; text-transform: uppercase;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: Not Ranked"); ?></span><br>
                            <?php else: ?>
                                <span style = "font-weight: 700; color: #5aa2c6; text-transform: uppercase;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: {position}", array('position' => $ranking['my_reviews']['position'] + 1)); ?></span><br>
                                <!-- <span style = "font-weight: 700; color: #5aa2c6; text-transform: uppercase;"><?php echo Yii::t('MissionsModule.leaderboard', "My Reviews Submitted: {evidences}", array('evidences' => $ranking['my_reviews']['reviews'])); ?></span> -->
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                        <?php echo Yii::t('MissionsModule.leaderboard', 'You are a mentor'); ?>
                    <?php endif; ?>

                </div> <!-- End of col-8 -->
            </div>
        </div>
        <div class="col-sm-4">
            <?php
            echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                    [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
            ]]);
            ?>
        </div>
   </div>
</div>

<style>

a.ranking{
    color:#A6AAB2;
    font-size:12pt;
}

a.ranking.current_tab, a.ranking:hover{
    color: #03ACC5;
    border-bottom: 2px solid;
    padding-bottom:10px;
}

</style>