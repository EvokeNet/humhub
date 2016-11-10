<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \humhub\modules\user\models\Profile;


class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evidence/edit";

    public $showFiles = false;

    public function run()
    {
      $user = $this->contentObject->content->user;

        return $this->render('entry', array('evidence' => $this->contentObject,
                    'user' => $user,
                    'name' => $user->getName(),
                    'contentContainer' => $this->contentObject->content->container));
    }

}
