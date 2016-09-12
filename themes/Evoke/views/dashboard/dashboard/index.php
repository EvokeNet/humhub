<?php

use app\modules\powers\models\UserPowers;

$user = Yii::$app->user->getIdentity();

$userPowers = UserPowers::getUserPowers($user->id);

// $this->pageTitle = Yii::t('DashboardModule.views_dashboard_index', 'Home');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 layout-content-container">

            <?php //if($user->group->name != "Mentors"): ?>
            <div class="panel-group">
                <?php
                echo \humhub\modules\missions\widgets\HomePageStats::widget();

                // echo "<br>";
                // echo \humhub\modules\missions\widgets\SuperPowerStats::widget(['powers' => $userPowers]);
                
                ?>
            </div>
            <?php //endif; ?>

            <?php
            if ($showProfilePostForm) {
                echo \humhub\modules\post\widgets\Form::widget(['contentContainer' => \Yii::$app->user->getIdentity()]);
            }
            ?>

            <?php
            echo \humhub\modules\content\widgets\Stream::widget([
                'streamAction' => '//missions/dashboard/stream',
                'showFilters' => false,
                'messageStreamEmpty' => Yii::t('DashboardModule.views_dashboard_index', '<b>Your dashboard is empty!</b><br>Post something on your profile or join some spaces!'),
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
