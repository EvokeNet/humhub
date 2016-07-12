<?php

namespace humhub\modules\missions\widgets;

use Yii;


class WallEvokationEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evokation/edit";
    
    public function run()
    {
        return $this->render('entry_evokation', array('evokation' => $this->contentObject,
                    'user' => $this->contentObject->content->user,
                    'contentContainer' => $this->contentObject->content->container));
    }

}