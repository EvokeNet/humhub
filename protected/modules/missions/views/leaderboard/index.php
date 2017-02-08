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

                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Teams By Evidences Submitted') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_teams_evidences'] as $key => $r): ?>
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
                        <?php if(!isset($ranking['my_team_evidences']) || $ranking['my_team_evidences']['position'] == -1): ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
                        <?php else: ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: {position}", array('position' => $ranking['my_team_evidences']['position'] + 1)); ?></span><br>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Evidences Submitted: {evidences}", array('evidences' => $ranking['my_team_evidences']['evidences'])); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Teams By Reviews Given') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_teams_reviews'] as $key => $r): ?>
                                <div class="col-sm-6">
                                    <div style = "padding: 5px 10px 10px; margin-bottom:15px; border-bottom: 2px solid #5aa2c6">

                                        <div class="row">
                                            <div class="col-sm-10" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
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
                        <?php if(!isset($ranking['my_team_reviews']) || $ranking['my_team_reviews']['position'] == -1): ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
                        <?php else: ?>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: {position}", array('position' => $ranking['my_team_reviews']['position'] + 1)); ?></span><br>
                            <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Reviews Submitted: {evidences}", array('evidences' => $ranking['my_team_reviews']['reviews'])); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Agents By Evidences Submitted') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_agents_evidences'] as $key => $r): ?>
                                <div class="col-sm-6">
                                    <div style = "padding: 5px 10px 10px; margin-bottom:15px; border-bottom: 2px solid #5aa2c6">

                                        <div class="row">
                                            <div class="col-sm-10" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                                <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                                <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']) ?>
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
                        <?php if (Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
                            <?php if($ranking['my_evidences']['position'] == -1): ?>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: Not Ranked"); ?></span><br>
                            <?php else: ?>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: {position}", array('position' => $ranking['my_evidences']['position'] + 1)); ?></span><br>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Evidences Submitted: {evidences}", array('evidences' => $ranking['my_evidences']['evidences'])); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Agents By Reviews Given') ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            <?php foreach($ranking['rank_agents_reviews'] as $key => $r): ?>
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
                        <?php if (Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
                            <?php if($ranking['my_reviews']['position'] == -1): ?>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: Not Ranked"); ?></span><br>
                            <?php else: ?>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Position: {position}", array('position' => $ranking['my_reviews']['position'] + 1)); ?></span><br>
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Reviews Submitted: {evidences}", array('evidences' => $ranking['my_reviews']['reviews'])); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Top Agents By Average Score -->
                    <div class="leaderboard-box">

                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo Yii::t('MissionsModule.leaderboard', 'Top Agents By Average Score') ?>
                            </h5>
                        </div>

                        <div class="row">
                            <?php foreach($ranking['rank_agents_score'] as $key => $r): ?>

                            <div class="col-sm-6">
                                <div class = "grey-box" style = "padding: 15px 20px; margin-bottom:15px">

                                    <div class="row">
                                        <div class="col-sm-9">
                                            <span class="l-name"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                            <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 11pt; font-weight: 700; color: #A6AAB2;']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <span class="l-number"><?php echo number_format($r['average'],2); ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <?php endforeach; ?>
                        </div>

                        <br />
                        <?php if (Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
                          <?php if($ranking['my_score']['position'] == -1): ?>
                              <span style = "font-size: 12pt; font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: Not Ranked'); ?></span><br>
                          <?php else: ?>
                              <span style = "font-size: 12pt; font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: {position}', array('position' => $ranking['my_score']['position'] + 1)); ?></span><br>
                              <span style = "font-size: 12pt; font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Score: {average}', array('average' => number_format($ranking['my_score']['average'],2))); ?></span>
                          <?php endif; ?>
                        <?php endif; ?>
                    </div>

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
                                <span style = "font-weight: 700; color: #5aa2c6;"><?php echo Yii::t('MissionsModule.leaderboard', "My Reviews Submitted: {evidences}", array('evidences' => $ranking['my_reviews']['reviews'])); ?></span>
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
