<?php

    return [
        'id' => 'missions',
        'class' => 'humhub\modules\missions\Module',
        'namespace' => 'humhub\modules\missions',
        'events' => array(
            array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\missions\Events', 'onTopMenuInit')),
        ),
        'urlManagerRules' => [
            'missions' => 'missions/missions'
        ]
    ];

?>
