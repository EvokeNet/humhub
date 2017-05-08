<?php

namespace app\modules\prize\widgets;

use \yii\base\Widget;
use app\modules\prize\models\WonPrize;
use app\modules\prize\models\Prize;

class WonPrizeWidget extends \yii\base\Widget
{
  public $user;

    /**
     * @inheritdoc
     */
    public function run()
    {
      $won_prize_records = WonPrize::find()->select('prize_id')->where(['user_id' => $this->user->id])->all();
      $won_prizes = [];

      foreach($won_prize_records as $won_prize_record) {
        $prize = Prize::find()->where(['id' => $won_prize_record->prize_id])->one();
        $won_prizes[] = $prize;
      }

        return $this->render('won_prizes', array('won_prizes' => $won_prizes));
    }

}

?>
