<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class PlayerStats extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('player_stats', ['userPowers' => $this->powers]);
    }

}

?>