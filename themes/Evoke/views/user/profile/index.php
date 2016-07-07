<?php 

use app\modules\powers\models\UserPowers;

$userPowers = UserPowers::getUserPowers($user->id);

echo \humhub\modules\missions\widgets\SuperPowerStats::widget(['powers' => $userPowers]);

//echo \humhub\modules\post\widgets\Form::widget(['contentContainer' => $user]); 

echo "<div class='panel panel-default'> <div class='panel-heading'> TO DO: Evidence Stream </div> </div>";
