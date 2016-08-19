<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\modules\user\widgets\ProfileSidebar;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\user\controllers\AuthController;

    return [
        'id' => 'matching',
        'class' => 'humhub\modules\matching_questions\Module',
        'namespace' => 'humhub\modules\matching_questions',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onTopMenuInit')),
        // ),
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onAdminMenuInit']],
            ['class' => AuthController::className(), 'event' => AuthController::EVENT_AFTER_ACTION, 'callback' => ['humhub\modules\matching_questions\Events', 'onAuthUser']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onQualityAdminMenuInit']],
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onSuperheroAdminMenuInit']],
            // ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\matching_questions\Events', 'onTopMenuInit']],
            ['class' => \humhub\modules\user\widgets\ProfileSidebar::className(), 'event' => ProfileSidebar::EVENT_INIT, 'callback' => ['\humhub\modules\matching_questions\Events', 'onProfileSidebarInit']],
        ],
        'urlManagerRules' => [
            'matching_questions' => 'matching_questions/matching_questions'
        ]
    ];

?>
