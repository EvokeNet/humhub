<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\space\widgets\Menu;
    use app\modules\missions\models\Evidence;

    return [
        'id' => 'achievements',
        'class' => 'humhub\modules\achievements\Module',
        'namespace' => 'humhub\modules\achievements',
        'events' => [
            //['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\achievements\Events', 'onAdminMenuInit']],
            //['class' => Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['\humhub\modules\achievements\Events', 'onSpaceMenuInit']],
            ['class' => Evidence::className(), 'event' => Evidence::EVENT_AFTER_INSERT, 'callback' => ['\humhub\modules\achievements\Events', 'onEvidenceAfterSave']],
            ['class' => Evidence::className(), 'event' => Evidence::EVENT_AFTER_UPDATE, 'callback' => ['\humhub\modules\achievements\Events', 'onEvidenceAfterSave']],
        ],
    ];

?>

