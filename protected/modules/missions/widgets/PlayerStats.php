<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class PlayerStats extends \yii\base\Widget
{

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('player_stats', []);
    }

}

?>