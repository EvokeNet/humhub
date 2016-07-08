<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class SuperPowerStats extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('super_power_stats', ['userPowers' => $this->powers]);
    }

}

?>