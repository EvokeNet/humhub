<?php

namespace humhub\modules\missions\widgets;

use Yii;
use yii\web\HttpException;

use app\modules\missions\models\Missions;
use app\modules\missions\models\Activities;
use app\modules\languages\models\Languages;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\Powers;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\Votes;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\EvokationCategories;
use app\modules\teams\models\Team;

use humhub\modules\space\models\Membership;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;


/**
 * MissionProgressWidget shows a team's progress in all missions
 */
class MissionProgressWidget extends \yii\base\Widget
{

    /**
     * Optional content container if this stream belongs to one
     *
     * @var HActiveRecordContentContainer
     */
    public $contentContainer;

     /**
     * @var \humhub\modules\space\models\Space
     */
    public $space;

    /**
     * Path to Stream Action to use
     *
     * @var string
     */
    public $streamAction = "";

    /**
     * Inits the activity stream widget
     */
    public function init()
    {
        if ($this->streamAction == "") {
            throw new HttpException(500, 'You need to set the streamAction attribute to use this widget!');
        }
    }

    /**
     * Runs the activity widget
     */
    public function run()
    {
        // $memberQuery = $this->space->getMemberships();
        // $memberQuery->joinWith('user');
        // $memberQuery->where(['user.status' => \humhub\modules\user\models\User::STATUS_ENABLED]);

        $members = Membership::find()
        ->joinWith(['user'])
        ->where(['space_id' => $this->space->id, 'user.status' => \humhub\modules\user\models\User::STATUS_ENABLED])
        ->all();

        // $rows = (new \yii\db\Query())
        // ->select(['user_id'])
        // ->from('space_membership')
        // ->where(['space_id' => $this->space->id])
        // ->all();

        // $rows = Membership::find()
        // ->where(['=', 'space_id', $this->space->id])
        // ->with([
        //     'user' => function ($query) {
        //         // $lang = Languages::findOne(['code' => Yii::$app->language]);
        //         // if(isset($lang))
        //         //     $query->andWhere(['language_id' => $lang->id]);
        //         // else{
        //         //     $lang = Languages::findOne(['code' => 'en-US']);
        //         //     $query->andWhere(['language_id' => $lang->id]);
        //         // }
        //         $query->andWhere(['user.id = space.user_id']);
        //     },
        //     'evidences' => function ($query) {
        //         $query->andWhere(['evidences.created_by = user.id']);
        //     },
        // ])
        // ->all();

        // $rows = Membership::find()
        // ->where(['=', 'space_id', $this->space->id])
        // ->joinWith(['user'])
        // ->joinWith('evidence', 'evidence.created_by = user.id')
        // ->all();

        $users = (new \yii\db\Query())
        ->select(['*'])
        ->from('space_membership as s')
        // ->join('INNER JOIN', 'user as u', 's.user_id = `u`.`id` AND u.object_model=\''.\humhub\modules\user\models\User::STATUS_ENABLED.'/')
        ->join('INNER JOIN', 'user as u', 's.user_id = `u`.`id`')
        ->join('INNER JOIN', 'profile as p', 'p.user_id = `u`.`id`')
        ->join('INNER JOIN', 'evidence as e', 'e.created_by = `u`.`id`')
        ->where(['space_id' => $this->space->id])
        ->all();

        $query = User::find();
        $query->leftJoin('space_membership', 'space_membership.user_id=user.id AND space_membership.space_id=:space_id AND space_membership.status=:member', ['space_id' => $this->space->id, 'member' => Membership::STATUS_MEMBER]);
        $query->andWhere('space_membership.space_id IS NOT NULL');
        // $query->leftJoin('evidence', 'evidence.created_by=user.id');
        $a1 = $query->all();
        
        $missions = Missions::find()
        ->with(['activities', 'activities.evidences', 'activities.activityPowers'])
        ->where(['missions.locked' => 0])
        // ->orderBy(['missions.position ASC', 'activities.position ASC'])
        ->all();

        return $this->render('mission_progress', array(
            'contentContainer' => $this->contentContainer,
            'missions' => $missions,
            'members' => $members,
            'users' => $users,
            'a1' => $a1
        ));
    }

    public static function getPrimaryPowerPoints($activity_id){
        $user = Yii::$app->user->getIdentity();

        $evidence_reward = (new \yii\db\Query())
        ->select(['ap.value'])
        ->from('evidence as e')
        ->join('LEFT JOIN', 'activity_powers as ap', 'ap.activity_id = `e`.`activities_id` AND ap.flag=0')
        ->where(['e.created_by' => $user->id])
        ->andWhere(['e.activities_id' => $activity_id])
        ->one()['value'];

        $total_votes = (new \yii\db\Query())
        ->select(['sum(v.value) as value'])
        ->from('evidence as e')
        ->join('LEFT JOIN', 'votes as v', 'v.evidence_id = `e`.`id`')
        ->where(['e.created_by' => $user->id])
        ->andWhere(['e.activities_id' => $activity_id])
        ->one()['value'];

        $total_points = $evidence_reward + $total_votes;

        //if user hasn't submitted any evidence
        if($total_points == 0){

            //Group activities
            $is_group_activity = (new \yii\db\Query())
            ->select(['a.is_group as is_group'])
            ->from('activities as a')
            ->where(['a.id' => $activity_id])
            ->one()['is_group'];

            //check if it's a group activity
            if($is_group_activity){
                $team_id = Team::getUserTeam($user->id);

                $evidence_reward = (new \yii\db\Query())
                ->select(['ap.value'])
                ->from('evidence as e')
                ->join('LEFT JOIN', 'activity_powers as ap', 'ap.activity_id = `e`.`activities_id` AND ap.flag=0')
                ->join('LEFT JOIN', 'space_membership as sm', 'sm.user_id = `e`.`created_by`')
                ->where(['sm.space_id' => $team_id])
                ->andWhere(['e.activities_id' => $activity_id])
                ->one()['value'];

                $total_votes = (new \yii\db\Query())
                ->select(['sum(v.value) as value'])
                ->from('evidence as e')
                ->join('LEFT JOIN', 'votes as v', 'v.evidence_id = `e`.`id`')
                ->join('LEFT JOIN', 'space_membership as sm', 'sm.user_id = `e`.`created_by`')
                ->where(['sm.space_id' => $team_id])
                ->andWhere(['e.activities_id' => $activity_id])
                ->one()['value'];

                return $evidence_reward + $total_votes;
            }
        }
            
        return $total_points;

        
    }

}

?>