<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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
}
