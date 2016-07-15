<?php

namespace humhub\modules\prize\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\prize\models\Prize;
use app\modules\prize\models\WonPrize;
use humhub\modules\user\models\User;

/**
 * Evoke Tools Controller
 *
 */
class EvokeToolsController extends Controller
{
    public $max_prob = 10000;

    public function actionIndex()
    {
        $prizes = Prize::find()->all();

        return $this->render('evoke_tools/index', array('prizes' => $prizes));
    }

    public function actionSearch()
    {
      $prizes = Prize::find()->where('quantity' > 0)->all();
      $roll = mt_rand(0, $this->max_prob);
      $probabilities = [];
      $available_prizes = [];
      $prize_won = '';

      // workout the probabilities for each prize
      // this is tied to when the prize was set to be available
      // i.e. if the prize has been around for a while it is more likely to come up
      foreach ($prizes as $prize) {
        $date = $prize->week_of;
        // see how long the prize has been available - affects the probability of winning it
        $time_diff = date_diff(new \DateTime($date), new \DateTime());
        $diff = (int)$time_diff->format('%R%a'); // int of days

        if ($diff >= 0) { //prize not available yet if diff < 0
          $prize_prob = $prize->weight * ($diff + 1);
          $probabilities[] = $prize_prob;
          $available_prizes[] = $prize;
        }
      }

      // figure out if they won anything
      // done by counting down from the max prob and seeing if they scored a number above it
      $prob_checker = $this->max_prob; //here to keep track of where we are in the number line
      foreach ($probabilities as $key => $probability) {
        $prob_checker -= $probability;

        if ($roll >= $prob_checker) { // they won!
          $prize_won = $available_prizes[$key];
          $available_prizes[$key]->quantity -= 1; // minus a quantity from the prize
          $available_prizes[$key]->save();

          $won_prize = new WonPrize();
          $won_prize->prize_id = $prize_won->id;
          $won_prize->user_id = $app->user->id;
          $won_prize->save();

          break;
        }
      }

      $results = '<div>' . $roll . '</div><strong>' . $date . '</strong><div>' . $diff . '</div><div>' . implode(',', $probabilities);

      return $this->render('evoke_tools/index', array('prizes' => $prizes, 'results' => $results));
    }
}
