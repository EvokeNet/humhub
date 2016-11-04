<?php

namespace humhub\modules\prize\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\modules\prize\models\Prize;
use app\modules\prize\models\WonPrize;
use app\modules\coin\models\Coin;
use app\modules\coin\models\Wallet;
use humhub\modules\user\models\User;
use app\modules\powers\models\UserQualities;
use app\modules\matching_questions\models\Qualities;
use app\modules\prize\models\SlotMachineStats;

/**
 * Evoke Tools Controller
 *
 */
class EvokeToolsController extends Controller
{
    public $max_prob = 1000;

    public function actionIndex()
    {
        $prizes = Prize::find()->where(['<=', 'week_of', date('Y-m-d')])->andWhere('quantity > :quantity', [':quantity' => '0'])->all();
        $coin_id = Coin::find()->where(['name' => 'EvoCoin'])->one()->id;
        $wallet = Wallet::find()->where(['owner_id' => Yii::$app->user->id, 'coin_id' => $coin_id])->one();
        $super_powers = Qualities::find()->all();

        $total_prizes = 0;

        foreach ($prizes as $prize) {
          $total_prizes += $prize->quantity;
        }

        if (array_key_exists('results', $_GET)) {
          $results = $_GET['results'];
        } else {
          $results = null;
        }

        return $this->render('evoke_tools/index', array('prizes' => $prizes, 'wallet' => $wallet, 'results' => $results, 'total_prizes' => $total_prizes, 'super_powers' => $super_powers));
    }

    public function actionSearch()
    {
      $user = Yii::$app->user->getIdentity();
      $prizes = Prize::find()->where('quantity > :quantity', [':quantity' => '0'])->all();
      $coin_id = Coin::find()->where(['name' => 'EvoCoin'])->one()->id;
      $wallet = Wallet::find()->where(['owner_id' => Yii::$app->user->id, 'coin_id' => $coin_id])->one();

      $roll = mt_rand(0, $this->max_prob);
      $probabilities = [];
      $available_prizes = [];
      $prize_won = '';
      $users_prizes = WonPrize::find()->where(['user_id' => $user->id])->all();

      // minus the 5 evocoin this action costs
      $wallet->amount -= 5;
      $wallet->save();

      // track the slotmachine use
      $user->slot_machine_uses++;
      $user->save();

      $slot_machine_stats = SlotMachineStats::find()->where(['id' => 1])->one();

      if ($slot_machine_stats == null) {
        $slot_machine_stats = new SlotMachineStats();
        $slot_machine_stats->id = 1;
      }

      $slot_machine_stats->uses++;

      // workout the probabilities for each prize
      // this is tied to when the prize was set to be available
      // i.e. if the prize has been around for a while it is more likely to come up
      foreach ($prizes as $prize) {
        $date = $prize->week_of;
        // see how long the prize has been available - affects the probability of winning it
        $time_diff = date_diff(new \DateTime($date), new \DateTime());
        $diff = (int)$time_diff->format('%R%a'); // int of days

        if ($diff >= 0) { //prize not available yet if diff < 0 (shouldnt be in query, but just in case)
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
          $user_has_prize = false;
          $prize_won = $available_prizes[$key];

          // check if user won this prize yet
          foreach ($users_prizes as $users_prize) {
            if ($users_prize->getPrize()->id == $prize_won->id) {
              $user_has_prize = true;
            }
          }

          // only give user the prize if they haven't won it yet, otherwise continue
          if (!$user_has_prize) {
            $prize_won->quantity -= 1; // minus a quantity from the prize
            $prize_won->save();

            $won_prize = new WonPrize();
            $won_prize->prize_id = $prize_won->id;
            $won_prize->user_id = Yii::$app->user->id;
            $won_prize->save();

            $prize_won_id = "prize" . $prize->id;
            $prize_won_name = $prize_won->name;
            $prize_won_description = $prize_won->description;

            break;
          } else {
            $prize_won = '';
            continue;
          }
        }
      }

      // if they didn't win a prize, check if they might have won some evocoin
      if ($prize_won === '') {
        if ($roll >= ($this->max_prob * 0.999)) {
          $prize_won_name = Yii::t('PrizeModule.base', '50 Evocoin(s)!');
          $prize_won_description = '';
          $prize_won_id = 'evocoin50';
          $wallet->addCoin(50);
          $slot_machine_stats->evocoin_created += 50;
          $wallet->save();
        }
        elseif ($roll >= ($this->max_prob * 0.98)) {
          $prize_won_name = Yii::t('PrizeModule.base', '20 Evocoin(s)!');
          $prize_won_description = '';
          $prize_won_id = 'evocoin20';
          $wallet->addCoin(20);
          $slot_machine_stats->evocoin_created += 20;
          $wallet->save();
        }
        elseif ($roll >= ($this->max_prob * 0.95)) {
          $prize_won_name = Yii::t('PrizeModule.base', '10 Evocoin(s)!');
          $prize_won_description = '';
          $prize_won_id = 'evocoin10';
          $wallet->addCoin(10);
          $slot_machine_stats->evocoin_created += 10;
          $wallet->save();
        }
        elseif ($roll >= ($this->max_prob * 0.85)) {
          $prize_won_name = Yii::t('PrizeModule.base', '5 Evocoin(s)!');
          $prize_won_description = '';
          $prize_won_id = 'evocoin5';
          $wallet->addCoin(5);
          $slot_machine_stats->evocoin_created += 5;
          $wallet->save();
        }
        else {
          $prize_won_name = Yii::t('PrizeModule.base', '1 Evocoin!');
          $prize_won_description = '';
          $prize_won_id = 'evocoin1';
          $wallet->amount += 1;
          $slot_machine_stats->evocoin_created += 1;
          $wallet->save();
        }
      }

      $slot_machine_stats->save();


      if (Yii::$app->request->isAjax) {
        $json = array('id' => $prize_won_id, 'name' => $prize_won_name, 'description' => $prize_won_description, 'evocoin' => $wallet->amount);

        $response = json_encode($json);
        return $response;
      } else {

        $results = '<div><strong>' . $prize_won_name . '</strong></div>';
        return $this->redirect(['index', 'results' => $results]);
      }
    }
}
