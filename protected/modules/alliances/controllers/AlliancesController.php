<?php

namespace humhub\modules\alliances\controllers;

use Yii;
use app\modules\alliances\models\Alliance;
use app\modules\teams\models\Team;
use app\modules\missions\models\Evidence;
use app\modules\missions\models\Votes;
use humhub\modules\content\components\ContentContainerController;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\powers\models\PowerTranslations;
use app\modules\missions\models\Activities;
use app\modules\missions\models\ActivityPowers;
use humhub\modules\missions\controllers\AlertController;
use humhub\modules\user\models\User;
use app\modules\coin\models\Wallet;
use app\modules\languages\models\Languages;


/**
 * AdminController
 *
 */
class AlliancesController extends ContentContainerController
{
  public function actionShow($id) {
    $alliance = Alliance::findOne($id);
    $user = Yii::$app->user->getIdentity();
    $team_id = Team::getUserTeam($user->id);
    $ally = $alliance->getAlly($team_id);

    return $this->render('show', ['aliiance' => $alliance, 'ally' => $ally]);
  }

  public function actionReview() {
    $user = Yii::$app->user->getIdentity();

    $flag = Yii::$app->request->get("opt") == "no" ? 0 : 1;
    $grade = Yii::$app->request->get("grade");
    $comment = Yii::$app->request->get("comment");
    $evidenceId = Yii::$app->request->get("evidenceId");
    $tags = Yii::$app->request->get("tags");
    $evidence = $evidenceId ? Evidence::findOne($evidenceId) : null;
    $evocoin_earned = 0;

    if (Votes::find()->where(['user_id' => $user->id, 'evidence_id' => $evidenceId])->exists()) {
      // we don't want double submission of reviews
      AlertController::createAlert("Error", Yii::t('AlliancesModule.base', 'Sorry, you already have a review'));
      return false;
    }


    if (empty($comment)) {
        //allies must comment
        AlertController::createAlert("Error", Yii::t('AlliancesModule.base', 'Sorry, you must leave a comment.'));
        return;
    }

    /*
          Check if review is valid:
          *** - it has a 'no' vote or a 1-5 'yes' vote
          *** - it has an evidence id associated
          *** - evidence author isn't the same user who's reviewing
      */
      if(($flag == 0 || $grade >= 1) && $evidenceId && $evidence->content->user_id != $user->id){
          $author = User::findOne($evidence->content->user_id);

          $is_group_activity = Activities::findOne(['id' => $evidence->activities_id])->is_group;

          $vote = new Votes();
          $vote->user_id = $user->id;
          $vote->activity_id = $evidence->activities_id;
          $vote->evidence_id = $evidenceId;
          $vote->comment = $comment;
          $vote->flag = $flag;
          $vote->value = $grade;
          $vote->user_type = $user->group->name;


          //Save Tags
          if($tags){
              foreach($tags as $tag_id){
                  $tag = new EvidenceTags();
                  $tag->tag_id = $tag_id;
                  $tag->evidence_id = $evidenceId;
                  $tag->user_id = $user->id;
                  $tag->created_at = new Expression('NOW()');
                  $tag->updated_at = new Expression('NOW()');
                  $tag->save();
              }
          }

          $evocoin_earned = 0;

          //Reward reviewer 5 evocoin
          $wallet = Wallet::find()->where(['owner_id' => $user->id])->one();
          $wallet->addCoin(5);
          $evocoin_earned += 5;

          $wallet->save();

          $activity_power = Activities::findOne($vote->activity_id)->getPrimaryPowers()[0];
          $review_power_points = $activity_power->value * 0.1;
          UserPowers::addPowerPoint($activity_power->getPower(), $user, $review_power_points);
          //Reward reviewer with 10% power points in the primary power

          //Reward evidence author
          if($flag){
              // if it's a group activity, we need to award points to all team members
              if ($is_group_activity) {
                // find the team and it's members
                $team_id = Team::getUserTeam($author->id);
                $team = Team::findOne($team_id);
                $team_members = $team->getTeamMembers();

                foreach ($team_members as $team_member) {
                  UserPowers::addPowerPoint($activity_power->getPower(), $team_member, $grade);
                }
              } else { // just award the current user
                //USER POWER POINTS
                UserPowers::addPowerPoint($activity_power->getPower(), $author, $grade);
              }
          }

          $power_name = Powers::findOne(['id' => $activity_power->power_id])->getName();

          // save vote
          $vote->save();

          $message = Yii::t('AlliancesModule.base', 'You just gained {evocoin} evocoins and {power_points} in {power}!', array('evocoin' => $evocoin_earned, 'power_points' => $review_power_points, 'power' => $power_name));

          AlertController::createAlert(Yii::t('MissionsModule.base', 'Congratulations!'), Yii::t('MissionsModule.base', '{message}. <BR>Thank you for your review.', array('message' => $message)));

          echo $this->renderPartial('..\..\..\missions\widgets\views\user_vote_view.php', array('vote' => $vote, 'contentContainer' => $this->contentContainer));

      } else{
          AlertController::createAlert("Error", Yii::t('AlliancesModule.base', 'You are missing one of the required fields'));
      }
  }
}
