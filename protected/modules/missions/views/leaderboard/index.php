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
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'GENERAL RANKINGS'), ['/missions/leaderboard/index'], ['class' => 'ranking current_tab', 'style' => '']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'POWERS RANKING'), ['/missions/leaderboard/powers'], ['class' => 'ranking', 'style' => '']) ?>                            
                        </div>
                    </div>

                    <!-- Top Teams by Quality Reviews given -->
                    <?php echo $this->render('box', array(
                        'ranking' => $ranking['rank_teams_quality_reviews'], 
                        'title' => Yii::t('MissionsModule.leaderboard', 'Top Teams By Quality Reviews Given'), 
                        'my_team' => $ranking['my_team_quality_reviews'], 
                        'type' => 'reviews',
                        'profile' => 'space',
                        'status' => 'default'
                    )); ?>

                    <!-- Top Teams by Quality Evidences given -->
                    <?php echo $this->render('box', array(
                        'ranking' => $ranking['rank_teams_quality_evidences'], 
                        'title' => Yii::t('MissionsModule.leaderboard', 'Top Teams By Quality Evidences Given'), 
                        'my_team' => $ranking['my_team_quality_evidences'], 
                        'type' => 'evidences',
                        'profile' => 'space',
                        'status' => 'default'
                    )); ?>

                    <!-- Most improved teams by mentor ratings -->
                    <?php echo $this->render('box', array(
                        'ranking' => $ranking['rank_most_improved_teams'], 
                        'title' => Yii::t('MissionsModule.leaderboard', 'Top Teams By Mentor Review Improvement'), 
                        'my_team' => $ranking['my_team_most_improved_teams'], 
                        'type' => 'rating',
                        'profile' => 'user',
                        'status' => 'default'
                    )); ?>

                    <!-- Top Mentor Reviews -->
                    <?php echo $this->render('box', array(
                        'ranking' => $ranking['rank_mentors_reviews'], 
                        'title' => Yii::t('MissionsModule.leaderboard', 'Top Mentors By Reviews Given'), 
                        'my_team' => (Yii::$app->user->getIdentity()->group->name == "Mentors") ? $ranking['my_reviews'] : '', 
                        'type' => 'reviews',
                        'profile' => 'user',
                        'status' => 'mentor'
                    )); ?>

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