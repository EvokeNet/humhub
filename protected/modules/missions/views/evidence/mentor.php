<?php

use \yii\helpers\Url;
use app\modules\missions\models\Evidence;
use yii\widgets\Breadcrumbs;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;

$mission_title = isset($activity->mission->missionTranslations[0]) ? $activity->mission->missionTranslations[0]->title : $activity->mission->title;

$activity_title = isset($activity->activityTranslations[0]) ? $activity->activityTranslations[0]->title : $activity->title;

$this->title = $mission_title; //Yii::t('MissionsModule.base', 'Activities');

$this->params['breadcrumbs'][] = ['label' => Yii::t('MissionsModule.base', 'Activities'), 'url' => ['evidence/mentor_activities', 'sguid' => $contentContainer->guid]];
$this->params['breadcrumbs'][] = Yii::t('MissionsModule.base', 'Activity {position} - {alias}', array('position' => $activity->position, 'alias' => $activity_title));

echo Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);

$this->pageTitle = Yii::t('MissionsModule.base', 'Activity {activity}', array('activity' => $activity_title));

$user = Yii::$app->user->getIdentity();


$spaces = (new \yii\db\Query())
->select(['f.object_id'])
->from('user_follow as f')
->where('f.object_model = \'' .str_replace("\\", "\\\\", Space::classname()).'\'') 
->andWhere('f.user_id = '.$user->id)
->all();

$users = (new \yii\db\Query())
->select(['f.object_id'])
->from('user_follow as f')
->where('f.object_model =:userClass', [':userClass' => User::className()]) 
->andWhere('f.user_id = '.$user->id)
->all();

$team_filters = [];

foreach($spaces as $space){
    $space = Space::findOne($space['object_id']);
    if($space){
        $team_filters["team".$space->id] = $space->name;    
    }
}


?>

<?php

$canCreateEvidences = false;

echo \app\modules\missions\widgets\EvidenceStream::widget(array(
    'contentContainer' => $contentContainer,
    'streamAction' => '/missions/evidence/mentorfeed',
    'messageStreamEmpty' => ($canCreateEvidences) ?
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet! Be the first and create one...') :
            Yii::t('MissionsModule.widgets_views_stream', 'There are no evidences yet!'),
    'messageStreamEmptyCss' => ($canCreateEvidences) ? 'placeholder-empty-stream' : '',
    'filters' => $team_filters,
    'activity_id' => $activity->id,
    'users_id' => $users,
    'spaces_id' => $spaces,
));

?>
