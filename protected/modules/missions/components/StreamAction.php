<?php

namespace humhub\modules\missions\components;

use Yii;
use humhub\modules\content\components\actions\ContentContainerStream;
use app\modules\missions\models\Evidence;

class StreamAction extends ContentContainerStream
{

    public $activity_id;

    public function setupFilters()
    {

        $this->activeQuery->andWhere(['content.object_model' => Evidence::className()]);

        if(isset($this->activity_id)){
            $this->activeQuery->leftJoin('evidence', 'content.object_id=evidence.id AND content.object_model=:evidenceClass', [':evidenceClass' => Evidence::className()]);
            $this->activeQuery->leftJoin('activities', 'evidence.activities_id = activities.id');
            $this->activeQuery->andWhere(['activities.id' => $this->activity_id]);
        }

    }

}

?>
