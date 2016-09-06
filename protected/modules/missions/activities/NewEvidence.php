<?php

namespace humhub\modules\missions\activities;

use humhub\modules\activity\components\BaseActivity;
use humhub\modules\activity\models\Activity;
use app\modules\missions\models\Evidence;
use humhub\modules\content\models\Content;
use humhub\modules\content\models\WallEntry;

class NewEvidence extends BaseActivity
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'missions';

    /**
     * @inheritdoc
     */
    public $viewName = 'newEvidence';

	public function render(){

        if($this->source == null){

        	//delete all defective evidence related activities

            $activities = Activity::findAll(['object_model' => Evidence::classname()]);

            foreach($activities as $activity){
                $evidence = Evidence::findOne($activity->object_id);

                if($evidence === null){

                    $content = Content::findOne(['object_model' => $activity->classname(), 'object_id' => $activity->id]);
                    $wallEntry = WallEntry::findOne(['content_id' => $content->id]);
                    $activity->delete();

                    if($content){
                    	$content->delete();
                    }
                    if($wallEntry){
                    	$wallEntry->delete();
                    }
                    
                }
            }

            return;
        }else{

            return parent::render();

        }

    }

}
