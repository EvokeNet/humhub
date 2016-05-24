<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'powers',
        'class' => 'humhub\modules\powers\Module',
        'namespace' => 'humhub\modules\powers',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onTopMenuInit')),
        // ),
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\powers\Events', 'onAdminMenuInit']],
            // ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onQualityAdminMenuInit']],
            // ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onSuperheroAdminMenuInit']],
            // ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\matching_questions\Events', 'onTopMenuInit']],
        ],
        'urlManagerRules' => [
            'powers' => 'powers/powers'
        ]
    ];

?>
