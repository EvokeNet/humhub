<?php

namespace humhub\modules\missions\components;

use Yii;
//use humhub\modules\content\components\actions\ContentContainerStream;
use app\modules\missions\models\Evokations;

class EvokationStreamAction extends EvokationsContentContainerStream
{

	public $mission_id;

    public function setupFilters()
    {

        $this->activeQuery->andWhere(['content.object_model' => Evokations::className()]);

        if(isset($this->mission_id)){
            $this->activeQuery->leftJoin('evokations', 'content.object_id=evokations.id AND content.object_model=:evokationClass', [':evokationClass' => Evokations::className()]);
            $this->activeQuery->leftJoin('missions', 'evokations.mission_id = missions.id');
            $this->activeQuery->andWhere(['missions.id' => $this->mission_id]);
        }
        if(isset($this->filterContentContainer) && $this->filterContentContainer){
            $this->activeQuery->andWhere(['content.space_id' => $this->contentContainer->id]);
        }

    }

}

?>
