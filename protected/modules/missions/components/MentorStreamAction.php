<?php

namespace humhub\modules\missions\components;

use Yii;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\Evokations;
use humhub\modules\post\models\Post;

class MentorStreamAction extends MentorContentContainerStream
{

    public function setupFilters()
    {
        $this->activeQuery->andFilterWhere(['or',
           ['content.object_model' => Evidence::className()]]);
    }

}

?>
