<?php

namespace humhub\modules\achievements\widgets;

use \yii\base\Widget;

class MyQualityReviews extends \yii\base\Widget
{

	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('my_quality_reviews');
    }

}

?>