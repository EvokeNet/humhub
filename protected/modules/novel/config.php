<?php

    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\user\controllers\AuthController;

    return [
        'id' => 'novel',
        'class' => 'humhub\modules\novel\Module',
        'namespace' => 'humhub\modules\novel',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\novel\Events', 'onAdminMenuInit']],
            ['class' => AuthController::className(), 'event' => AuthController::EVENT_AFTER_ACTION, 'callback' => ['humhub\modules\novel\Events', 'onAuthUser']],
        ],
        'urlManagerRules' => [
            'novel' => 'novel/novel'
        ]
    ];

?>
