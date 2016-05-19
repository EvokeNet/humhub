<?php

namespace humhub\modules\missions\components;

use Yii;
use humhub\modules\content\components\actions\ContentContainerStream;
use humhub\modules\missions\models\Evidence;

class StreamAction extends ContentContainerStream
{

    public function setupFilters()
    {
        $this->activeQuery->andWhere(['content.object_model' => Evidence::className()]);
    }

}

?>
