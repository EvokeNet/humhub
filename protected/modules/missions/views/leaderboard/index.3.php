<?php

use yii\helpers\Html;

    // echo "<pre>";
    // print_r($ranking);
    // echo "</pre>";

$this->pageTitle = Yii::t('MissionsModule.page_titles', 'Leaderboard');

?>

<div class="container">
    <div class="row">
        <div class="col-sm-8">

            <div class="panel panel-default">

                <h3 style = "padding: 20px; font-weight:bold"><?php echo Yii::t('MissionsModule.leaderboard', 'Leaderboard') ?></h3>

                <!-- Top Teams By Evidences Submitted -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.leaderboard', 'Top Teams By Evidences Submitted') ?></h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach($ranking['rank_teams_evidences'] as $key => $r): ?>

                            <div class="col-sm-6">
                                <div class = "grey-box" style = "padding: 15px 20px; margin-bottom:15px">

                                    <div class="row">
                                        <div class="col-sm-10" style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                            <span style = "font-size: 14pt; font-weight: 700; color: #254054;"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                            <?= Html::a($r['name'], ['/space/space', 'sguid' => $r['guid']], ['style' => 'font-size: 14pt; font-weight: 700; color: #2273AC;']) ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <span style = "float:right; font-size: 14pt; color: #3399E1; font-weight: 700;"><?php echo $r['evidences']; ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>

                    <?php if(!isset($ranking['my_team_evidences']) || $ranking['my_team_evidences']['position'] == -1): ?>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
                    <?php else: ?>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: {position}", array('position' => $ranking['my_team_evidences']['position'] + 1)); ?></span><br>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Evidences Submitted: {evidences}", array('evidences' => $ranking['my_team_evidences']['evidences'])); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Top Teams By Reviews Given -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.leaderboard', 'Top Teams By Reviews Given') ?></h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach($ranking['rank_teams_reviews'] as $key => $r): ?>

                            <div class="col-sm-6">
                                <div class = "grey-box" style = "padding: 15px 20px; margin-bottom:15px">

                                    <div class="row">
                                        <div class="col-sm-9">
                                            <span style = "font-size: 14pt; font-weight: 700; color: #254054;"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                            <?= Html::a($r['name'], ['/space/space', 'sguid' => $r['guid']], ['style' => 'font-size: 14pt; font-weight: 700; color: #2273AC;']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <span style = "float:right; font-size: 14pt; color: #3399E1; font-weight: 700;"><?php echo $r['reviews']; ?></span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>

                    <?php if(!isset($ranking['my_team_reviews']) || $ranking['my_team_reviews']['position'] == -1): ?>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: Not Ranked"); ?></span><br>
                    <?php else: ?>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Position: {position}", array('position' => $ranking['my_team_reviews']['position'] + 1)); ?></span><br>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', "My Team's Reviews Submitted: {evidences}", array('evidences' => $ranking['my_team_reviews']['reviews'])); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Top Agents By Evidences Submitted -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.leaderboard', 'Top Agents By Evidences Submitted') ?></h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach($ranking['rank_agents_evidences'] as $key => $r): ?>

                        <div class="col-sm-6">
                            <div class = "grey-box" style = "padding: 15px 20px; margin-bottom:15px">

                                <div class="row">
                                    <div class="col-sm-9">
                                        <span style = "font-size: 14pt; font-weight: 700; color: #254054;"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                        <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 14pt; font-weight: 700; color: #2273AC;']) ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <span style = "float:right; font-size: 14pt; color: #3399E1; font-weight: 700;"><?php echo $r['evidences']; ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>

                    <?php if($ranking['my_evidences']['position'] == -1): ?>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: Not Ranked'); ?></span><br>
                    <?php else: ?>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: {position}', array('position' => $ranking['my_evidences']['position'] + 1)); ?></span><br>
                        <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Evidences Submitted: {evidences}', array('evidences' => $ranking['my_evidences']['evidences'])); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Top Agents By Reviews Given -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.leaderboard', 'Top Agents By Reviews Given') ?></h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach($ranking['rank_agents_reviews'] as $key => $r): ?>

                        <div class="col-sm-6">
                            <div class = "grey-box" style = "padding: 15px 20px; margin-bottom:15px">

                                <div class="row">
                                    <div class="col-sm-9">
                                        <span style = "font-size: 14pt; font-weight: 700; color: #254054;"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                        <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 14pt; font-weight: 700; color: #2273AC;']) ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <span style = "float:right; font-size: 14pt; color: #3399E1; font-weight: 700;"><?php echo $r['reviews']; ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                    <?php if (Yii::$app->user->getIdentity()->group->name != "Mentors"): ?>
                      <?php if($ranking['my_reviews']['position'] == -1): ?>
                          <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: Not Ranked'); ?></span><br>
                      <?php else: ?>
                          <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: {position}', array('position' => $ranking['my_reviews']['position'] + 1)); ?></span><br>
                          <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Reviews Submitted: {evidences}', array('evidences' => $ranking['my_reviews']['reviews'])); ?></span>
                      <?php endif; ?>
                      <?php //echo Yii::t('MissionsModule.leaderboard', 'My Team Reviews Submitted: {evidences}', array('evidences' => $ranking['my_reviews']['reviews'])); ?>
                    <?php endif; ?>
                </div>

                <!-- Top Mentors By Reviews Given -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.leaderboard', 'Top Mentors By Reviews Given') ?></h4>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <?php foreach($ranking['rank_mentors_reviews'] as $key => $r): ?>

                        <div class="col-sm-6">
                            <div class = "grey-box" style = "padding: 15px 20px; margin-bottom:15px">

                                <div class="row">
                                    <div class="col-sm-9">
                                        <span style = "font-size: 14pt; font-weight: 700; color: #254054;"><?php echo $key + 1; ?>.</span>&nbsp;&nbsp;
                                        <?= Html::a($r['username'], ['/user/profile', 'uguid' => $r['guid']], ['style' => 'font-size: 14pt; font-weight: 700; color: #2273AC;']) ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <span style = "float:right; font-size: 14pt; color: #3399E1; font-weight: 700;"><?php echo $r['reviews']; ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php endforeach; ?>
                    </div>
                    <?php if (Yii::$app->user->getIdentity()->group->name == "Mentors"): ?>
                      <?php if($ranking['my_reviews']['position'] == -1): ?>
                          <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: Not Ranked'); ?></span><br>
                      <?php else: ?>
                          <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Position: {position}', array('position' => $ranking['my_reviews']['position'] + 1)); ?></span><br>
                          <span style = "font-size: 12pt; font-weight: 700; color: #254054;"><?php echo Yii::t('MissionsModule.leaderboard', 'My Reviews Submitted: {evidences}', array('evidences' => $ranking['my_reviews']['reviews'])); ?></span>
                      <?php endif; ?>
                      <?php //echo Yii::t('MissionsModule.leaderboard', 'My Team Reviews Submitted: {evidences}', array('evidences' => $ranking['my_reviews']['reviews'])); ?>
                    <?php endif; ?>
                </div>
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
