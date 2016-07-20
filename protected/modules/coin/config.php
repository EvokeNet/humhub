<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\user\widgets\ProfileSidebar;
    use app\modules\coin\models\Coin;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\user\controllers\AuthController;

    return [
        'id' => 'coin',
        'class' => 'humhub\modules\coin\Module',
        'namespace' => 'humhub\modules\coin',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\coin\Events', 'onAdminMenuInit']],
            ['class' => AuthController::className(), 'event' => AuthController::EVENT_AFTER_ACTION, 'callback' => ['humhub\modules\coin\Events', 'onAuthUser']],
        ],
        'urlManagerRules' => [
            'coin' => 'coin/coin'
        ]
    ];

?>
