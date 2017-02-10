<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'alliances',
        'class' => 'humhub\modules\alliances\Module',
        'namespace' => 'humhub\modules\alliances',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\alliances\Events', 'onAdminMenuInit']],
        ],
        'urlManagerRules' => [
            'alliances' => 'alliances/'
        ]
    ];

?>
