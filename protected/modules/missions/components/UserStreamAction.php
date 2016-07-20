<?php

namespace humhub\modules\missions\components;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\Evokations;

class UserStreamAction extends UserContentContainerStream
{

    public function setupFilters()
    {
        $this->activeQuery->andFilterWhere(['or',
           ['content.object_model' => Evidence::className()],
           ['content.object_model' => Evokations::className()]]);
    }

}

?>
