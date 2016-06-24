<?php

namespace humhub\modules\matching_questions\widgets;

use \yii\base\Widget;

class SuperHeroWidget extends Widget
{


	public $superhero_id;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('superhero_menu', array('superhero_id' => $this->superhero_id));
    }

}

?>