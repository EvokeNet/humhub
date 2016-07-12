<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class PortfolioWidget extends \yii\base\Widget
{

	public $portfolio;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('portfolio', ['portfolio' => $this->portfolio]);
    }

}

?>