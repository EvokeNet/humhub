<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'stats',
        'class' => 'humhub\modules\stats\Module',
        'namespace' => 'humhub\modules\stats',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\stats\Events', 'onAdminMenuInit']],
            //['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\custom_pages\Events', 'onTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\books\Events', 'onTopMenuInit']],
        ],
        'urlManagerRules' => [
            'stats' => 'stats/matching-stats'
        ]
    ];

?>
