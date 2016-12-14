<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;

class EvocoinsReview extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('evocoins_review', []);
    }

}

?>