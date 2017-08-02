<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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
 * This is the model class for table "activities".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $mission_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $id_code
 * @property integer $difficulty_level_id
 * @property string $rubric
 * @property integer $evokation_category_id
 * @property integer $position
 * @property string $message
 *
 * @property DifficultyLevels $difficultyLevel
 * @property EvokationCategories $evokationCategory
 * @property Missions $mission
 * @property ActivityPowers[] $activityPowers
 * @property ActivityTranslations[] $activityTranslations
 * @property Evidence[] $evidences
 * @property Skills[] $skills
 * @property Votes[] $votes
 */
class Activities extends \yii\db\ActiveRecord
{
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
        return 'activities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'mission_id'], 'required'],
            [['description', 'id_code', 'rubric'], 'string'],
            [['mission_id', 'difficulty_level_id', 'evokation_category_id', 'position'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['message'], 'string', 'max' => 256],
            [['difficulty_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => DifficultyLevels::className(), 'targetAttribute' => ['difficulty_level_id' => 'id']],
            [['evokation_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => EvokationCategories::className(), 'targetAttribute' => ['evokation_category_id' => 'id']],
            [['mission_id'], 'exist', 'skipOnError' => true, 'targetClass' => Missions::className(), 'targetAttribute' => ['mission_id' => 'id']],
            [['is_group'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MissionsModule.model', 'ID'),
            'title' => Yii::t('MissionsModule.model', 'Title'),
            'description' => Yii::t('MissionsModule.model', 'Description'),
            'mission_id' => Yii::t('MissionsModule.model', 'Mission ID'),
            'created_at' => Yii::t('MissionsModule.model', 'Created At'),
            'updated_at' => Yii::t('MissionsModule.model', 'Updated At'),
            'id_code' => Yii::t('MissionsModule.model', 'Id Code'),
            'difficulty_level_id' => Yii::t('MissionsModule.model', 'Difficulty Level ID'),
            'rubric' => Yii::t('MissionsModule.model', 'Rubric'),
            'evokation_category_id' => Yii::t('MissionsModule.model', 'Evokation Category ID'),
            'position' => Yii::t('MissionsModule.model', 'Position'),
            'message' => Yii::t('MissionsModule.model', 'Evidence Success Message'),
            'is_group' => Yii::t('MissionsModule.model', 'Is a Group Activity'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDifficultyLevel()
    {
        return $this->hasOne(DifficultyLevels::className(), ['id' => 'difficulty_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvokationCategory()
    {
        return $this->hasOne(EvokationCategories::className(), ['id' => 'evokation_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMission()
    {
        return $this->hasOne(Missions::className(), ['id' => 'mission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityPowers()
    {
        return $this->hasMany(ActivityPowers::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityTranslations()
    {
        return $this->hasMany(ActivityTranslations::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidences()
    {
        return $this->hasMany(Evidence::className(), ['activities_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skills::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Votes::className(), ['activity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrimaryPowers()
    {
        $powers = ActivityPowers::findAll(['activity_id' => $this->id, 'flag' => 0]);
        return $powers;
    }

     /**
     * @return \yii\db\ActiveQuery
     */
    public function getSecondaryPowers()
    {
        $powers = ActivityPowers::findAll(['activity_id' => $this->id, 'flag' => 1]);
        return $powers;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubricVotes()
    {
        return $this->hasMany(RubricVotes::className(), ['activity_id' => 'id']);
    }

    public static function getPrimaryPowerPoints($activity_id, $user_id){

        // $user = User::find()
        // ->where(['id' => $user_id])
        // ->all();

        $evidence_reward = (new \yii\db\Query())
        ->select(['ap.value'])
        ->from('evidence as e')
        ->join('LEFT JOIN', 'activity_powers as ap', 'ap.activity_id = `e`.`activities_id` AND ap.flag=0')
        ->where(['e.created_by' => $user_id])
        ->andWhere(['e.activities_id' => $activity_id])
        ->one()['value'];

        $total_votes = (new \yii\db\Query())
        ->select(['sum(v.value) as value'])
        ->from('evidence as e')
        ->join('LEFT JOIN', 'votes as v', 'v.evidence_id = `e`.`id`')
        ->where(['e.created_by' => $user_id])
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
                $team_id = Team::getUserTeam($user_id);

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
