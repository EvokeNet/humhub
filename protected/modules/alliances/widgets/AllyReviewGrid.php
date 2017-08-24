<?php

namespace humhub\modules\alliances\widgets;

use Yii;
use \humhub\modules\user\models\Profile;
use app\modules\missions\models\Mission;


class AllyReviewGrid extends \yii\base\Widget
{
    public function run($ally)
    {
      $missions = Mission::find()->all();

        return $this->render('ally_review_grid', array(
          'missions' => $missions,
          'ally' => $ally,
          // 'ally_members' => $ally_members,
        ));
    }

}
