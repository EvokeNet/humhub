<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;

class HomePageStatsWidget extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('home_page_stats', []);
    }

}

?>