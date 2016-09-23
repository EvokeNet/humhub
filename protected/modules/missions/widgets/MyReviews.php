<?php

namespace humhub\modules\missions\widgets;

use \yii\base\Widget;

class MyReviews extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('my_reviews');
    }

}

?>