<?php

use app\modules\powers\models\UserPowers;

$userPowers = UserPowers::getUserPowers(Yii::$app->user->getIdentity()->id);

$this->pageTitle = Yii::t('DashboardModule.views_dashboard_index', 'Dashboard X');
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 layout-content-container">
            <div class="panel-group">
                <?php
                echo \humhub\modules\missions\widgets\HomePageStats::widget();
                echo "<br>";
                echo \humhub\modules\missions\widgets\SuperPowerStats::widget(['powers' => $userPowers]);
                ?>
            </div>
            <?php
            if ($showProfilePostForm) {
                echo \humhub\modules\post\widgets\Form::widget(['contentContainer' => \Yii::$app->user->getIdentity()]);
            }
            ?>

            <?php
            echo \humhub\modules\content\widgets\Stream::widget([
                'streamAction' => '//dashboard/dashboard/stream',
                'showFilters' => false,
                'messageStreamEmpty' => Yii::t('DashboardModule.views_dashboard_index', '<b>Your dashboard is empty!</b><br>Post something on your profile or join some spaces!'),
            ]);
            ?>
        </div>
        <div class="col-md-4 layout-sidebar-container">
            <?php
            echo \humhub\modules\dashboard\widgets\Sidebar::widget(['widgets' => [
                    [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/dashboard/dashboard/stream'], ['sortOrder' => 150]]
            ]]);
            ?>
        </div>
    </div>
</div>
