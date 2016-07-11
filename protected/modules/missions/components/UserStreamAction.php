<?php

namespace humhub\modules\missions\components;

use Yii;
use app\modules\missions\models\Evidence;

class UserStreamAction extends UserContentContainerStream
{

    public function setupFilters()
    {

        $this->activeQuery->andWhere(['content.object_model' => Evidence::className()]);

    }

}

?>
