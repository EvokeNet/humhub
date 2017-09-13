<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'library',
        'class' => 'humhub\modules\library\Module',
        'namespace' => 'humhub\modules\library',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\library\Events', 'onAdminMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\library\Events', 'onTopMenuInit']],
        ],
        'urlManagerRules' => [
            'library' => 'library/'
        ]
    ];

?>
