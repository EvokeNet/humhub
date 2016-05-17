<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class EvidenceWidget extends Widget
{


    /**
     * @var \humhub\modules\space\models\Space
     */
    public $space;

    /**
     * @inheritdoc
     */
    public function run()
    {

        return $this->render('evidence', []);
    }

}

?>