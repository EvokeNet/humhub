<?php

return [
    'id' => 'superhero_identity',
    'class' => 'humhub\modules\superhero_identity\Module',
    'namespace' => 'humhub\modules\superhero_identity',
    'events' => array(
            array('class' => \humhub\widgets\TopMenu::className(), 'event' => \humhub\widgets\TopMenu::EVENT_INIT, 'callback' => array('\humhub\modules\superhero_identity\Events', 'onTopMenuInit')),
        )
];
?>