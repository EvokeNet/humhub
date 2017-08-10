<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;
    use humhub\modules\user\controllers\AuthController;

    return [
        'id' => 'statics',
        'class' => 'humhub\modules\statics\Module',
        'namespace' => 'humhub\modules\statics',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onTopMenuInit')),
        //     array('class' => \humhub\widgets\AdminMenu::className(), 'event' => \humhub\widgets\AdminMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onAdminMenuInit')),
        // ),
        'events' => [
            //['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\languages\Events', 'onAdminMenuInit']],
            //['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\custom_pages\Events', 'onTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\statics\Events', 'onAboutTopMenuInit']],
            ['class' => AuthController::className(), 'event' => AuthController::EVENT_AFTER_ACTION, 'callback' => ['humhub\modules\statics\Events', 'onAuthUser']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\statics\Events', 'onHowToTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\statics\Events', 'onPrivacyPolicyTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\statics\Events', 'onTermsTopMenuInit']],
        ],
        // 'urlManagerRules' => [
        //     'matching_questions' => 'matching_questions/matching-questions'
        // ]
    ];

?>
