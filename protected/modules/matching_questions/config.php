<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'matchingQuestions',
        'class' => 'humhub\modules\matching_questions\Module',
        'namespace' => 'humhub\modules\matching_questions',
        // 'events' => array(
        //     array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onTopMenuInit')),
        //     array('class' => \humhub\widgets\AdminMenu::className(), 'event' => \humhub\widgets\AdminMenu::EVENT_INIT, 'callback' => array('\humhub\modules\matching_questions\Events', 'onAdminMenuInit')),
        // ),
        'events' => [
            //['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\matching_questions\Events', 'onAdminMenuInit']],
            //['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\custom_pages\Events', 'onTopMenuInit']],
            ['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\matching_questions\Events', 'onTopMenuInit']],
        ],
        // 'urlManagerRules' => [
        //     'matching_questions' => 'matching_questions/matching-questions'
        // ]
    ];

?>
