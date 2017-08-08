<?php

    use humhub\modules\user\widgets\AccountMenu;
    use humhub\modules\admin\widgets\AdminMenu;
    use humhub\widgets\BaseMenu;
    use humhub\widgets\TopMenu;

    return [
        'id' => 'languages',
        'class' => 'humhub\modules\languages\Module',
        'namespace' => 'humhub\modules\languages',
        'events' => [
            ['class' => \humhub\modules\admin\widgets\AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\languages\Events', 'onAdminMenuInit']],
            //['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\custom_pages\Events', 'onTopMenuInit']],
            //['class' => \humhub\widgets\TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['\humhub\modules\books\Events', 'onTopMenuInit']],
        ],
        // 'urlManagerRules' => [
        //     'matching_questions' => 'matching_questions/matching-questions'
        // ]
    ];

?>
