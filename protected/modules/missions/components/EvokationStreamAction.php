<?php

namespace humhub\modules\missions\components;

use Yii;
use humhub\modules\content\components\actions\ContentContainerStream;
use app\modules\missions\models\Evokations;

class EvokationStreamAction extends ContentContainerStream
{

    public function setupFilters()
    {

        $this->activeQuery->andWhere(['content.object_model' => Evokations::className()]);

    }

}

?>
