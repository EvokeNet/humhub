<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\user\widgets\ProfileSidebar;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'coin',
        'class' => 'humhub\modules\coin\Module',
        'namespace' => 'humhub\modules\coin',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\coin\Events', 'onAdminMenuInit']],
            ['class' => \humhub\modules\user\widgets\ProfileSidebar::className(), 'event' => ProfileSidebar::EVENT_INIT, 'callback' => ['\humhub\modules\coin\Events', 'onProfileSidebarInit']],
        ],
        'urlManagerRules' => [
            'coin' => 'coin/coin'
        ]
    ];

?>
