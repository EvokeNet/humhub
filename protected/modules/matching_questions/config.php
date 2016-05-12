<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'matching_questions',
        'class' => 'humhub\modules\matching_questions\MatchingQuestions',
        'namespace' => 'humhub\modules\matching_questions',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onTopMenuInit')),
        // ),
        // 'urlManagerRules' => [
        //     'matching_questions' => 'matching_questions/matching-questions'
        // ]
        'events' => [
            // ['class' => AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onAdminMenuInit']],
            ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onTopMenuInit']],
            // ['class' => AccountMenu::className(), 'event' => AccountMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onAccountMenuInit']],
            // ['class' => humhub\modules\space\widgets\Menu::className(), 'event' => humhub\modules\space\widgets\Menu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onSpaceMenuInit']],
            // // v0.20 and prior
            // ['class' => humhub\modules\space\widgets\AdminMenu::className(), 'event' => humhub\modules\space\widgets\AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onSpaceAdminMenuInit']],
            // // v.021 and above
            // ['class' => 'humhub\modules\space\modules\manage\widgets\Menu', 'event' => BaseMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onSpaceAdminMenuInit']],
        ],
    ];

?>
