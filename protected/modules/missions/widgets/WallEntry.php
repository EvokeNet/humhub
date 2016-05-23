<?php

namespace humhub\modules\missions\widgets;

use Yii;


class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evidence/edit";
    
    public function run()
    {
        return $this->render('entry', array('evidence' => $this->contentObject,
                    'user' => $this->contentObject->content->user,
                    'contentContainer' => $this->contentObject->content->container));
    }

}