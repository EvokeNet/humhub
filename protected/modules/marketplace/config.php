<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\user\widgets\ProfileSidebar;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'marketplace',
        'class' => 'humhub\modules\marketplace\Module',
        'namespace' => 'humhub\modules\marketplace',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\marketplace\Events', 'onAdminMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\marketplace\Events', 'onTopMenuInit']],
        ],
        'urlManagerRules' => [
            'marketplace' => 'marketplace/'
        ]
    ];

?>
