<?php

$user = Yii::$app->user->getIdentity();

$this->pageTitle = Yii::t('MissionsModule.base', 'Dashboard');

?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 layout-content-container">

            <?php //if($user->group->name != "Mentors"): ?>
            <div class="panel-group">
                <?php
                //echo \humhub\modules\missions\widgets\HomePageStats::widget();

                // echo "<br>";
                // echo \humhub\modules\missions\widgets\SuperPowerStats::widget(['powers' => $userPowers]);
                
                ?>
            </div>
            <?php //endif; ?>

            <?php
            echo \humhub\modules\missions\widgets\DashboardStream::widget([
                'streamAction' => '//missions/mentor/stream',
                'showFilters' => false
            ]);
            ?>
        </div>
        
        <div class="col-sm-4 layout-sidebar-container">
            <?php
            echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                    [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150, ['label' => 'yay']]]
            ]]);
            ?>
        </div>
    </div>
</div>
