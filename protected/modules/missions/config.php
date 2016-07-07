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
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\missions\Events', 'onTopMenuInit')),
        // ),
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onAdminMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onCategoriesAdminMenuInit']],
            ['class' => \humhub\modules\user\widgets\ProfileSidebar::className(), 'event' => ProfileSidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onProfileSidebarInit']],
            ['class' => LikeController::className(), 'event' => LikeController::EVENT_BEFORE_ACTION, 'callback' => ['humhub\modules\missions\Events', 'onUserLike']],
            ['class' => \humhub\modules\space\widgets\Sidebar::className(), 'event' => Sidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onSidebarInit']],
            ['class' => \humhub\modules\dashboard\widgets\Sidebar::className(), 'event' => \humhub\modules\dashboard\widgets\Sidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onDashboardSidebarInit']],
            ['class' => '\humhub\modules\installer\controllers\ConfigController', 'event' => 'install_sample_data', 'callback' => ['humhub\modules\missions\Events', 'onSampleDataInstall']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onTopMenuInit']],
            ['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onMissionSpaceMenuInit']],
            ['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onEvokationSpaceMenuInit']],
            ['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onReviewSpaceMenuInit']],

        ],
        'urlManagerRules' => [
            'missions' => 'missions/missions'
        ]
    ];

?>
