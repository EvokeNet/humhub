<?php
    
    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\space\widgets\sideBar;
    use humhub\modules\like\controllers\LikeController;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\space\widgets\Menu;
    use humhub\modules\user\widgets\ProfileSidebar;
    
    return [
        'id' => 'missions',
        'class' => 'humhub\modules\missions\Module',
        'namespace' => 'humhub\modules\missions',
        'events' => [
            ['class' => \humhub\modules\user\widgets\AccountMenu::className(), 'event' => AccountMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onAccountMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onAdminMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onCategoriesAdminMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onEvidencesAdminMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onReviewsAdminMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onLockdownAdminMenuInit']],
            ['class' => \humhub\modules\dashboard\widgets\Sidebar::className(), 'event' => \humhub\modules\dashboard\widgets\Sidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onDashboardSidebarInit']],
            ['class' => \humhub\modules\space\widgets\Sidebar::className(), 'event' => Sidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onSidebarInit']],
            ['class' => \humhub\modules\space\widgets\Sidebar::className(), 'event' => Sidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onSidebarRun']],
            ['class' => \humhub\modules\user\widgets\ProfileSidebar::className(), 'event' => ProfileSidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onProfileSidebarInit']],
            ['class' => \humhub\modules\user\widgets\ProfileMenu::className(), 'event' => ProfileSidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onProfileMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onTopMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_RUN, 'callback' => ['\humhub\modules\missions\Events', 'onTopMenuRun']],
            ['class' => LikeController::className(), 'event' => LikeController::EVENT_BEFORE_ACTION, 'callback' => ['humhub\modules\missions\Events', 'onUserLike']],
            ['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onSpaceMenuInit']],
            ['class' => '\humhub\modules\installer\controllers\ConfigController', 'event' => 'install_sample_data', 'callback' => ['humhub\modules\missions\Events', 'onSampleDataInstall']],
        ],
        'urlManagerRules' => [
            'missions' => 'missions/missions'
        ]
    ];

?>
