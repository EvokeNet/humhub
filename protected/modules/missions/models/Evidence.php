<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use yii\db\ActiveRecord;
use app\modules\languages\models\Languages;
use app\modules\space\models\Space;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\modules\missions\models\Votes;
use app\modules\matching_questions\models\User;
use humhub\modules\content\models\Content;
use app\modules\missions\models\ActivityPowers;
use app\modules\powers\models\UserPowers;
use app\modules\teams\models\Team;
use app\modules\missions\models\Activities;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\Missions;
use app\modules\missions\models\TeamMission;
use app\modules\alliances\models\Alliance;

/**
 * This is the model class for table "evidence".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $main_content
 * @property string $content
 * @property integer $user_id
 * @property integer $activities_id
 * @property integer $space_id
 * @property string $created
 * @property string $modified
 *
 * @property Space $space
 * @property Activities $activities
 * @property User $user
 */
class Evidence extends ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_EDIT = 'edit';
    const SCENARIO_CLOSE = 'close';
    public $autoAddToWall = true;
    public $wallEntryClass = 'humhub\modules\missions\widgets\WallEntry';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evidence';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CLOSE => [],
            self::SCENARIO_CREATE => ['title', 'text'],
            self::SCENARIO_EDIT => ['title', 'text']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 120],
            [['created_at', 'updated_at'], 'safe'],
            // [['created_by', 'updated_by'], 'integer'],
            [['updated_by'], 'integer'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['activities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activities_id' => 'id']],
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('MissionsModule.model', 'ID'),
            'title' => Yii::t('MissionsModule.model', 'Title'),
            //'type' => Yii::t('MissionsModule.model', 'Type'),
            //'main_content' => Yii::t('MissionsModule.model', 'Main Content'),
            'text' => Yii::t('MissionsModule.model', 'Text'),
            //'user_id' => Yii::t('MissionsModule.model', 'User ID'),
            'activities_id' => Yii::t('MissionsModule.model', 'Activities ID'),
            'created_at' => Yii::t('MissionsModule.model', 'Created At'),
            'created_by' => Yii::t('MissionsModule.model', 'Created By'),
            'updated_at' => Yii::t('MissionsModule.model', 'Updated At'),
            'updated_by' => Yii::t('MissionsModule.model', 'Updated By'),
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        // $activity = Activities::findOne($this->activities_id);

        $activity = Activities::find()
        ->where(['=', 'id', $this->activities_id])
        ->with([
            'activityTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
            'mission.missionTranslations' => function ($query) {
                $lang = Languages::findOne(['code' => Yii::$app->language]);
                if(isset($lang))
                    $query->andWhere(['language_id' => $lang->id]);
                else{
                    $lang = Languages::findOne(['code' => 'en-US']);
                    $query->andWhere(['language_id' => $lang->id]);
                }
            },
        ])->one();

        return $activity;
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('MissionsModule.models_Missions', "Evidence");
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        return array(
            'title' => $this->title
        );
    }

    public function getContentObject(){
        return Content::findOne(['object_id' => $this->id, 'object_model' => $this->classname()]);
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthor(){
        return User::findOne($this->created_by);
    }

    public function hasUserVoted($userId = "")
    {
        if ($userId == "")
            $userId = Yii::$app->user->id;

        $vote = Votes::findOne(array('user_id' => $userId, 'evidence_id' => $this->id));

        if ($vote == null)
            return false;

        return true;
    }

    public function evidenceForActivityStatus($activityId = "", $userId = ""){

        $evidence = Evidence::findOne(['activities_id' => $activityId, 'created_by' => $userId]);

        $flag = '';
        $current_user = Yii::$app->user->getIdentity();
        $author_alliance = Alliance::find()->findByTeam(Team::getUserTeam($userId))->one();
        $is_ally = false;
        if($author_alliance){
            $is_ally = $author_alliance->isAlly(Team::getUserTeam($current_user->id));
        }

        if ($current_user->group->name == "Mentors" || $is_ally) {
          $can_review = true;
        } else {
          $can_review = false;
        }

        if(!$evidence){
            $flag = 'empty';
        } else{
            $vote_ally = Votes::findOne(['evidence_id' => $evidence->id, 'user_type' => 'Users']);
            $vote_mentor = Votes::findOne(['evidence_id' => $evidence->id, 'user_type' => 'Mentors']);
            $vote_current_user =Votes::findOne(['evidence_id' => $evidence->id, 'user_id' => $current_user->id]);

            if($vote_ally && $vote_mentor){
                $flag = 'both';
            } else if($vote_ally && !$vote_mentor){
                $flag = 'vote_ally';
            } else if(!$vote_ally && $vote_mentor){
                $flag = 'vote_mentor';
            } else{
                $flag = 'submit';
            }

            if (!$vote_current_user && $can_review) {
              $flag .= ' pulse';
            }
        }

        return $flag;
    }

    public function hasUserSubmittedEvidence($activityId = "", $userId = "")
    {

        if($activityId == "")
            return false;

        if ($userId == "")
            $userId = Yii::$app->user->id;

        $activity = Activities::findOne(['id' => $activityId]);

        // check if activity is a group activity
        // if so we must look for anyone in the team with a submitted evidence
        if ($activity->is_group) {
          // find the team and its members
          $team_id = Team::getUserTeam($userId);
          $team = Team::findOne($team_id);

          if(!$team){
            return true;
          }

          $team_members = $team->getTeamMembers();

          foreach ($team_members as $team_member) {
            $evidence_exists = Evidence::find()->where(['activities_id' => $activityId, 'created_by' => $team_member->id])->exists();

            if ($evidence_exists) {
              return true;
            }

          }


        } else { // it's not a group activity, so just find the users evidence
          $evidence_exists = Evidence::find()->where(['activities_id' => $activityId, 'created_by' => $userId])->exists();
        }

        if($evidence_exists){
            return true;
        }

        return false;
    }


    public function getUserVote($userId = "")
    {

        if ($userId == "")
            $userId = Yii::$app->user->id;

        return Votes::findOne(array('user_id' => $userId, 'evidence_id' => $this->id));
    }

    public function getAverageRating($user_type = "Mentors")
    {

        $query = (new \yii\db\Query())

        ->select(['sum(value) / count(id) as average'])
        ->from('votes')
        ->where(['evidence_id' => $this->id,
                 'user_type'   => $user_type])
        ->one();

        return $query['average'];

    }

    public function getUserAverageRating($user_id)
    {

        $query = (new \yii\db\Query())

        ->select(['sum(v.value) / count(v.id) as average'])
        ->from('votes as v')
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `v`.`evidence_id`')
        ->where(['c.user_id' => $user_id])
        ->one();

        return $query['average'];

    }

    public function getVotes($user_type = null)
    {
      if (isset($user_type)){
        return Votes::find()->where(['evidence_id' => $this->id, 'user_type'   => $user_type])->orderBy('created_at DESC')->all();
      } else {
        return Votes::find()->where(['evidence_id' => $this->id])->orderBy('created_at DESC')->all();
      }
    }


    public function getVoteCount($user_type = "Mentors")   {

        $query = (new \yii\db\Query())

        ->select(['count(id) as count'])
        ->from('votes')
        ->where(['evidence_id' => $this->id,
                 'user_type'   => $user_type])
        ->one();

        return $query['count'];

    }

    public function getEvidenceCountForUser($user_id) {
      $query = (new \yii\db\Query())

      ->select(['count(id) as count'])
      ->from('evidence')
      ->where(['created_by' => $user_id])
      ->one();

      return $query['count'];
    }

    /**
     * After Saving of evidences, fire an activity
     *
     * @return type
     */
    public function afterSave($insert, $changedAttributes)
    {

        $activity = new  \humhub\modules\missions\activities\NewEvidence();
        $activity->source = $this;
        $activity->originator = Yii::$app->user->getIdentity();
        $activity->create();


        // Handle mentioned users
        // Execute before NewCommentNotification to avoid double notification when mentioned.
        \humhub\modules\user\models\Mentioning::parse($this, $this->text);

        if ($insert) {
            $notification = new \humhub\modules\missions\notifications\NewEvidence();
            $notification->source = $this;
            $notification->originator = Yii::$app->user->getIdentity();
            $notification->sendBulk($this->content->getPolymorphicRelation()->getFollowers(null, true, true));
        }

        return parent::afterSave($insert, $changedAttributes);

    }


    public function beforeDelete()
    {
        $votes = Votes::findAll(['evidence_id' => $this->id]);

        foreach($votes as $vote){
            $vote->delete();
        }

        $activityPowers = ActivityPowers::findAll(['activity_id' => $this->activities_id]);
        $user = User::findOne($this->created_by);

        if(isset($user)){
            //REMOVE USER POWER POINTS
            foreach($activityPowers as $activity_power){
                UserPowers::removePowerPoint($activity_power->getPower(), $user, $activity_power->value);
            }

            //Remove evocoins
            $is_group_activity = Activities::findOne(['id' => $this->activities_id])->is_group;

            if($is_group_activity){
                $team_id = Team::getUserTeam($this->created_by);
                $team = Team::findOne($team_id);
                $team_members = $team->getTeamMembers();

                foreach ($team_members as $team_member) {
                    $wallet = Wallet::find()->where(['owner_id' => $team_member->id])->one();
                    $wallet->removeCoin(10);
                    $wallet->save();
                }

            }else{
                $wallet = Wallet::find()->where(['owner_id' => $this->created_by])->one();
                $wallet->removeCoin(10);
                $wallet->save();
            }

        }

        return parent::beforeDelete();
    }

    public static function getUserEvidence($user_id, $activity_id){
        return Evidence::findOne(['created_by' => $user_id, 'activities_id' => $activity_id]);
    }

}
