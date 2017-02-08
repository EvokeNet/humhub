<?php 

echo \humhub\modules\post\widgets\Form::widget(['contentContainer' => $space]); 
$this->pageTitle = Yii::t('SpaceModule.views_space_index', '{group}', array('group' => $space->name));

?>

<?php

echo \humhub\modules\content\widgets\Stream::widget(array(
    'contentContainer' => $space,
    'streamAction' => '/missions/space/stream',
    'messageStreamEmpty' => ($space->canWrite()) ?
            Yii::t('SpaceModule.views_space_index', '<b>This space is still empty!</b><br>Start by posting something here...') :
            Yii::t('SpaceModule.views_space_index', '<b>You are not member of this space and there is no public content, yet!</b>'),
    'messageStreamEmptyCss' => ($space->canWrite()) ?
            'placeholder-empty-stream' :
            '',
));
?>