<?php

    // echo "<pre>";
    // print_r($ranking);
    // echo "</pre>";
    
?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            
            <div class="panel panel-default">
                
                <h3><?php echo Yii::t('MissionsModule.base', 'Leaderboard') ?></h3>
                
                <!-- Top Teams By Evidences Submitted -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.base', 'Top Teams By Evidences Submitted') ?></h4>
                </div>
                
                <div class="panel-body">
                    <?php foreach($ranking['rank_teams_evidences'] as $key => $r): ?>
                        <div class = "grey-box" style = "padding: 15px 20px;">
                            <?php echo $key + 1; ?>.&nbsp;&nbsp;
                            <?php echo $r['name']; ?>
                            <span style = "float:right"><?php echo $r['evidences']; ?></span>
                        </div><br>
                    <?php endforeach; ?>
                    <?php echo Yii::t('MissionsModule.base', 'My Position: {position}', array('position' => $ranking['my_team_evidences']['position'])); ?><br>
                    <?php echo Yii::t('MissionsModule.base', 'My Team Evidences Submitted: {evidences}', array('evidences' => $ranking['my_team_evidences']['evidences'])); ?>
                </div>
                
                <!-- Top Teams By Reviews Given -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.base', 'Top Teams By Reviews Given') ?></h4>
                </div>
                
                <div class="panel-body">
                    <?php foreach($ranking['rank_teams_reviews'] as $key => $r): ?>
                        <div class = "grey-box" style = "padding: 15px 20px;">
                            <?php echo $key + 1; ?>.&nbsp;&nbsp;
                            <?php echo $r['name']; ?>
                            <span style = "float:right"><?php echo $r['reviews']; ?></span>
                        </div><br>
                    <?php endforeach; ?>
                    <?php echo Yii::t('MissionsModule.base', 'My Position: {position}', array('position' => $ranking['my_team_reviews']['position'])); ?><br>
                    <?php echo Yii::t('MissionsModule.base', 'My Team Reviews Submitted: {evidences}', array('evidences' => $ranking['my_team_reviews']['reviews'])); ?>
                </div>
                
                <!-- Top Agents By Evidences Submitted -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.base', 'Top Agents By Evidences Submitted') ?></h4>
                </div>
                
                <div class="panel-body">
                    <?php foreach($ranking['rank_agents_evidences'] as $key => $r): ?>
                        <div class = "grey-box" style = "padding: 15px 20px;">
                            <?php echo $key + 1; ?>.&nbsp;&nbsp;
                            <?php echo $r['username']; ?>
                            <span style = "float:right"><?php echo $r['evidences']; ?></span>
                        </div><br>
                    <?php endforeach; ?>
                    <?php echo Yii::t('MissionsModule.base', 'My Position: {position}', array('position' => $ranking['my_evidences']['position'])); ?><br>
                    <?php echo Yii::t('MissionsModule.base', 'Your Evidences Submitted: {evidences}', array('evidences' => $ranking['my_evidences']['evidences'])); ?>
                </div>
                
                <!-- Top Agents By Reviews Given -->
                <div class="panel-heading">
                    <h4><?php echo Yii::t('MissionsModule.base', 'Top Agents By Reviews Given') ?></h4>
                </div>
                
                <div class="panel-body">
                    <?php foreach($ranking['rank_agents_reviews'] as $key => $r): ?>
                        <div class = "grey-box" style = "padding: 15px 20px;">
                            <?php echo $key + 1; ?>.&nbsp;&nbsp;
                            <?php echo $r['username']; ?>
                            <span style = "float:right"><?php echo $r['reviews']; ?></span>
                        </div><br>
                    <?php endforeach; ?>
                    <?php echo Yii::t('MissionsModule.base', 'My Position: {position}', array('position' => $ranking['my_reviews']['position'])); ?><br>
                    <?php echo Yii::t('MissionsModule.base', 'My Team Reviews Submitted: {evidences}', array('evidences' => $ranking['my_reviews']['reviews'])); ?>
                </div>
                
            </div>
            
        </div>
        
        <div class="col-md-4">
            <?php
            echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                    [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
            ]]);
            ?>
        </div>
   </div>     
</div>