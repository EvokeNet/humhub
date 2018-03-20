<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\space\widgets\Menu;

    return [
        'id' => 'alliances',
        'class' => 'humhub\modules\alliances\Module',
        'namespace' => 'humhub\modules\alliances',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\alliances\Events', 'onAdminMenuInit']],
            ['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\alliances\Events', 'onSpaceMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\alliances\Events', 'onTopMenuInit']],
        ],
        'urlManagerRules' => [
            'alliances' => 'alliances/'
        ]
    ];

?>
