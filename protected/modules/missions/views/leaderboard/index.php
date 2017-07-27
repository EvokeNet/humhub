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
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'TEAMS RANKING'), ['/missions/leaderboard/index'], ['class' => 'ranking current_tab', 'style' => '']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'POWERS RANKING'), ['/missions/leaderboard/powers'], ['class' => 'ranking', 'style' => '']) ?>                            
                        </div>
                    </div>

                    <!-- Top Teams by Quality Reviews given -->
                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Teams By Quality Reviews Given') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_teams_quality_reviews'] as $key => $r): ?>
                                <div class="col-sm-6">
                                    <div style = "padding: 5px 10px 10px; margin-bottom:15px; border-bottom: 2px solid #5aa2c6">

                                        <div class="row">
                                            <div class="col-sm-10">

                                                <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                                <?= Html::a($r['name'], ['/space/space', 'sguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']) ?>

                                            </div>
                                            <div class="col-sm-2">

                                                <span class="l-number"><?php echo $r['reviews']; ?></span>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <br />
                        <?php if(!isset($ranking['my_team_quality_reviews']) || $ranking['my_team_quality_reviews']['position'] == -1): ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
                        <?php else: ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: {position}", array('position' => $ranking['my_team_quality_reviews']['position'] + 1)); ?></span><br>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Evidences Submitted: {reviews}", array('reviews' => $ranking['my_team_quality_reviews']['reviews'])); ?></span>
                        <?php endif; ?>
                    </div>

                     <!-- Top Teams by Quality Evidences given -->
                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Teams By Quality Evidences Given') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_teams_quality_evidences'] as $key => $r): ?>
                                <div class="col-sm-6">
                                    <div style = "padding: 5px 10px 10px; margin-bottom:15px; border-bottom: 2px solid #5aa2c6">

                                        <div class="row">
                                            <div class="col-sm-10">

                                                <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                                <?= Html::a($r['name'], ['/space/space', 'sguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']) ?>

                                            </div>
                                            <div class="col-sm-2">

                                                <span class="l-number"><?php echo $r['evidences']; ?></span>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <br />
                        <?php if(!isset($ranking['my_team_quality_evidences']) || $ranking['my_team_quality_evidences']['position'] == -1): ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
                        <?php else: ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: {position}", array('position' => $ranking['my_team_quality_evidences']['position'] + 1)); ?></span><br>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Evidences Submitted: {evidences}", array('evidences' => $ranking['my_team_quality_evidences']['evidences'])); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Top Mentor Reviews -->
                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Mentors By Reviews Given') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_mentors_reviews'] as $key => $r): ?>
                                <div class="col-sm-6">
                                    <div style = "padding: 5px 10px 10px; margin-bottom:15px; border-bottom: 2px solid #5aa2c6">

                                        <div class="row">
                                            <div class="col-sm-10" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                                <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                                <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']) ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <span class="l-number"><?php echo $r['reviews']; ?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php endforeach; ?>
                        </div>

                        <br />
                        <?php if (Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
                            <?php if($ranking['my_reviews']['position'] == -1): ?>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: Not Ranked"); ?></span><br>
                            <?php else: ?>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: {position}", array('position' => $ranking['my_reviews']['position'] + 1)); ?></span><br>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Reviews Submitted:: {evidences}", array('evidences' => $ranking['my_reviews']['reviews'])); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div> <!-- End of col-8 -->

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