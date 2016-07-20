<?php

namespace humhub\modules\missions\widgets;

use Yii;
use app\modules\missions\models\EvokationDeadline;


class WallEvokationEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evokation/edit";
    
    public function run()
    {
        $deadline = EvokationDeadline::find()->one();
        
        return $this->render('entry_evokation', array(
            'evokation' => $this->contentObject,
            'user' => $this->contentObject->content->user,
            'deadline' => $deadline,
            'contentContainer' => $this->contentObject->content->container
            )
        );
    }

}