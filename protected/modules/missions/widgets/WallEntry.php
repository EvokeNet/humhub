<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \humhub\modules\user\models\Profile;


class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evidence/edit";

    public function run()
    {
      $user = $this->contentObject->content->user;
      $profile = Profile::find()->where(['user_id' => $user->id])->one();
      $name = $profile->firstname . ' ' . $profile->lastname;


        return $this->render('entry', array('evidence' => $this->contentObject,
                    'user' => $user,
                    'name' => $name,
                    'contentContainer' => $this->contentObject->content->container));
    }

}
