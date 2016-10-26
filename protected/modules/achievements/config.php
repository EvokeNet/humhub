<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\space\widgets\Menu;

    return [
        'id' => 'achievements',
        'class' => 'humhub\modules\achievements\Module',
        'namespace' => 'humhub\modules\achievements',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\achievements\Events', 'onAdminMenuInit']],
            ['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\achievements\Events', 'onSpaceMenuInit']],
        ],

    ];

?>
