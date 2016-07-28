<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class CreateATeamWidget extends \yii\base\Widget
{


    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('create_a_team', []);
    }

}

?>