<?php

namespace humhub\modules\matching_questions\widgets;

use \yii\base\Widget;

class SuperHeroWidget extends Widget
{

	public $superhero_id;

  public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      if ($this->superhero_id !== NULL) {
        return $this->render('superhero_menu', ['superhero_id' => $this->superhero_id, 'user' => $this->user]);
      }
      return;
    }

}

?>
