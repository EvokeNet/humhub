<?php

namespace humhub\modules\missions\components;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\Evokations;
use humhub\modules\post\models\Post;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;

class MentorStreamAction extends MentorContentContainerStream
{

	public $activity_id = null;
    public $users_id = null;
    public $spaces_id = null;

    public function setupFilters()
    {

        // if (in_array('id', $this->filters)) {
        //     print_r($this->filters);
        // }

        $spaces_query = $this->returnIdQuery($this->spaces_id);
        $users_query = $this->returnIdQuery($this->users_id);

        if(isset($this->activity_id)){
            $this->activeQuery->leftJoin('evidence', 'content.object_id=evidence.id AND content.object_model=:evidenceClass', [':evidenceClass' => Evidence::className()]);
            $this->activeQuery->andWhere(['evidence.activities_id' => $this->activity_id]);
        }

        if(sizeof($this->spaces_id) > 0 && sizeof($this->users_id) > 0){
            $this->activeQuery->andWhere(
               'content.space_id in '.$spaces_query.
               ' OR content.user_id in '.$users_query
           ); 
        }elseif(sizeof($this->spaces_id) > 0){
            $this->activeQuery->andWhere(
            'content.space_id in '.$spaces_query
            ); 
        }elseif(sizeof($this->users_id) > 0){
            $this->activeQuery->andWhere(
            'content.user_id in '.$users_query
            );
        }else{
            $this->activeQuery->andWhere('1 = 2');
        }

        $this->activeQuery->andFilterWhere(
           ['content.object_model' => Evidence::className()]);

        $teams_filter = [];

        foreach($this->filters as $filter){

            $length = strlen($filter);

            //filter may be a team filter
            if($length > 4){
                //filter it is a team filter
                if(substr($filter, 0, 4) === 'team'){
                    //add id to array
                    $object['object_id'] = (int) substr($filter, 4, $length);
                    array_push($teams_filter, $object);
                }    
            }
           
        }

        if(sizeof($teams_filter) > 0){

            $teamsfilter_query = $this->returnIdQuery($teams_filter);
            $this->activeQuery->andWhere(
                'content.space_id in '.$teamsfilter_query
            ); 
        }
        
           
    }

    public function returnIdQuery($objects){
    	$object_query = "(";
        $objects_size = sizeof($objects);
        $count = 0;

        if($objects_size <= 0){
            return "()";
        }

        foreach($objects as $object){
        	$count++;

        	$object_query = $object_query . $object['object_id'];

        	if($count < $objects_size){
        		$object_query = $object_query . ",";
        	}
         	
        }

        $object_query = $object_query . ")";

		return $object_query;
    }

}

?>
