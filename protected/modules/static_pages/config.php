<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'static_pages',
        'class' => 'humhub\modules\static_pages\Module',
        'namespace' => 'humhub\modules\static_pages',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onTopMenuInit')),
        //     array('class' => \humhub\widgets\AdminMenu::className(), 'event' => \humhub\widgets\AdminMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onAdminMenuInit')),
        // ),
        'events' => [
            //['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\languages\Events', 'onAdminMenuInit']],
            //['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\custom_pages\Events', 'onTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\static_pages\Events', 'onAboutTopMenuInit']],
            // ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\static_pages\Events', 'onHowToTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\static_pages\Events', 'onPrivacyPolicyTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\static_pages\Events', 'onTermsTopMenuInit']],
        ],
        // 'urlManagerRules' => [
        //     'matching_questions' => 'matching_questions/matching-questions'
        // ]
    ];

?>
