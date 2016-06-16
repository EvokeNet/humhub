<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class PopUpWidget extends \yii\base\Widget
{


    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('popup', []);
    }

}

?>