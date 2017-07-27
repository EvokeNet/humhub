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
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'TEAMS RANKING'), ['/missions/leaderboard/index'], ['class' => 'ranking', 'style' => '']) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= Html::a(Yii::t('MissionsModule.leaderboard', 'POWERS RANKING'), ['/missions/leaderboard/powers'], ['class' => 'ranking current_tab', 'style' => '']) ?>                            
                        </div>
                    </div>

                    <div style="float:right">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <?php echo Yii::t('MissionsModule.leaderboard', "SELECT POWER"); ?>
                            <span class="caret"></span>
                          </button>

                          <ul class="dropdown-menu" style="background-color:#101C2A;">
                            <li><?= Html::a(Yii::t('MissionsModule.leaderboard', 'POWER ONE'), ['/missions/leaderboard/powers', 'id' => 'power'], ['class' => 'ranking', 'style' => '']) ?> </li>
                            <li><?= Html::a(Yii::t('MissionsModule.leaderboard', 'POWER TWO'), ['/missions/leaderboard/powers', 'id' => 'power_two'], ['class' => 'ranking', 'style' => '']) ?> </li>
                          </ul>
                        </div>
                    </div>

                    <br><br>

                    <div class="leaderboard-box">
                        <div style="text-align: center">
                            <h5 style="color:#FEAE1B">
                              <?php echo $ranking; ?>
                            </h5>
                        </div>
                        <br />
                        <div class="row">
                            

                        <br />
                        <span>My team</span>
                        </div>
                    </div>

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