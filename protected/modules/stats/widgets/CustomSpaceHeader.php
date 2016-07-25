<?php

namespace humhub\modules\stats\widgets;

use Yii;
use \yii\base\Widget;
use humhub\modules\space\widgets\Header;
use app\modules\missions\models\Missions;
use app\modules\missions\models\Evidence;
use app\modules\coin\models\Wallet;
use humhub\modules\content\models\Content;
use humhub\modules\post\models\Post;

class CustomSpaceHeader extends Header
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $postCount = Content::find()->where(['object_model' => Post::className(), 'space_id' => $this->space->id])->count();
        
        $missions = Missions::find()
        ->where(['locked' => 0])
        ->all();
        
        $total = 0;
        $done = 0;
        $doneActivity = false;
        $evidencesTotal = 0;

        foreach($missions as $m):

            foreach($m->activities as $activity):
                $total++;
                foreach ($activity->evidences as $evidence):                     
                    if($evidence->content->space_id == $this->space->id){ 
                        $evidencesTotal += count($activity->evidences);
                    }

                    if($doneActivity){
                        $done++;  
                        $doneActivity = true;  
                        break;
                    }
                endforeach;
                $doneActivity = false;
            endforeach;
                                        
        endforeach;

        return $this->render('customSpaceHeader', array(
                    'mission' => $missions,
                    'total' => $total,
                    'done' => $done,
                    'evidencesTotal' => $evidencesTotal,
                    'space' => $this->space,
                    'postCount' => $postCount
        ));
    }

}

?>
