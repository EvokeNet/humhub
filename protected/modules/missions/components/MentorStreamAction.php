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

	public $activity_id;

    public function setupFilters()
    {

        $spaces = (new \yii\db\Query())
        ->select(['f.object_id'])
        ->from('user as u')
        ->join('INNER JOIN', 'user_follow as f', 'u.id = `f`.`user_id`')
        ->where('f.object_model = \'' .str_replace("\\", "\\\\", Space::classname()).'\'') 
        ->andWhere('u.id = '.$this->user->id)
        ->all();

        $spaces_query = $this->returnIdQuery($spaces);

        $users = (new \yii\db\Query())
        ->select(['f.object_id'])
        ->from('user as u')
        ->join('INNER JOIN', 'user_follow as f', 'u.id = `f`.`user_id`')
        ->where('f.object_model =:userClass', [':userClass' => User::className()]) 
        ->andWhere('u.id = '.$this->user->id)
        ->all();

        $users_query = $this->returnIdQuery($users);

        if(isset($this->activity_id)){
            $this->activeQuery->leftJoin('evidence', 'content.object_id=evidence.id AND content.object_model=:evidenceClass', [':evidenceClass' => Evidence::className()]);
            $this->activeQuery->andWhere(['evidence.activities_id' => $this->activity_id]);
        }

        if(sizeof($spaces) > 0 && sizeof($users) >= 0){
            $this->activeQuery->andWhere(
           'content.space_id in '.$spaces_query.
           ' OR content.user_id in '.$users_query
           ); 
        }elseif(sizeof($spaces) > 0){
            $this->activeQuery->andWhere(
            'content.space_id in '.$spaces_query
            ); 
        }elseif(sizeof($users) > 0){
            $this->activeQuery->andWhere(
            'content.user_id in '.$users_query
            );
        }

        $this->activeQuery->andFilterWhere(
           ['content.object_model' => Evidence::className()]);
           
    }

    public function returnIdQuery($objects){
    	$object_query = "(";
        $objects_size = sizeof($objects);
        $count = 0;

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
