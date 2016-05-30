<?php

namespace humhub\modules\powers\widgets;

use \yii\base\Widget;

class UserPowersWidget extends Widget
{


	public $powers;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('powers_menu', array('powers' => $this->powers));
    }

}

?>