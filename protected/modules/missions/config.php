<?php
    
    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\space\widgets\sideBar;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    
    return [
        'id' => 'missions',
        'class' => 'humhub\modules\missions\Module',
        'namespace' => 'humhub\modules\missions',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\missions\Events', 'onTopMenuInit')),
        // ),
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\missions\Events', 'onAdminMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onTopMenuInit']],
            ['class' => \humhub\modules\space\widgets\Sidebar::className(), 'event' => Sidebar::EVENT_INIT, 'callback' => ['\humhub\modules\missions\Events', 'onSidebarInit']],
            ['class' => '\humhub\modules\installer\controllers\ConfigController', 'event' => 'install_sample_data', 'callback' => ['humhub\modules\missions\Events', 'onSampleDataInstall']],
        ],
        'urlManagerRules' => [
            'missions' => 'missions/missions'
        ]
    ];

?>
