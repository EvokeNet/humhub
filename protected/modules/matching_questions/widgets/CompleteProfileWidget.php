<?php

namespace humhub\modules\matching_questions\widgets;

use yii\helpers\Url;
use \yii\base\Widget;

class CompleteProfileWidget extends Widget
{

  public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      $user = $this->user;

      if ($user->has_read_novel == true) {
        $url = Url::toRoute('/matching_questions/matching-questions/matching');
      } else {
        $url = Url::toRoute(['/novel/novel/graphic-novel', 'page' => 1]);
      }

      return $this->render('complete_profile', ['url' => $url]);
    }

}

?>
