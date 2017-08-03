<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\modules\novel\models\Chapter;

/**
 * This is the model class for table "missions".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $id_code
 * @property integer $locked
 * @property integer $position
 *
 * @property Activities[] $activities
 * @property MissionTranslations[] $missionTranslations
 */
class Missions extends \yii\db\ActiveRecord
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
        return 'missions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description', 'id_code'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['locked', 'position'], 'integer'],
            [['title'], 'string', 'max' => 255],
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
            'created_at' => Yii::t('MissionsModule.model', 'Created At'),
            'updated_at' => Yii::t('MissionsModule.model', 'Updated At'),
            'id_code' => Yii::t('MissionsModule.model', 'Id Code'),
            'locked' => Yii::t('MissionsModule.model', 'Locked'),
            'position' => Yii::t('MissionsModule.model', 'Position'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activities::className(), ['mission_id' => 'id'])->orderBy('ISNULL(position), position ASC');
    }

    public function getCompletedActivities($space_id){
        return (new \yii\db\Query())
        ->select(['ac.id'])
        ->from('activities as ac')
        ->join('LEFT JOIN', 'missions as m', 'ac.mission_id = `m`.`id`')
        ->join('LEFT JOIN', 'evidence as e', 'e.activities_id = `ac`.`id`')
        ->join('LEFT JOIN', 'content as c', 'c.object_id = `e`.`id` AND c.object_model like "%Evidence%"')
        ->join('LEFT JOIN', 'user as u', 'e.created_by = `u`.`id`')
        ->join('LEFT JOIN', 'space_membership as sm', 'sm.user_id = `u`.`id`')
        ->join('LEFT JOIN', 'space as s', 'sm.space_id = `s`.`id`')
        ->where(['m.id' => $this->id, 's.id' => $space_id, 'c.visibility' => 1])
        ->all();
    }

    public function hasTeamCompleted($space_id){
        if(sizeof($this->getCompletedActivities($space_id)) >= sizeof($this->activities)){
            return true;
        }
        return false;
    }

    public function isTeamGoingToComplete($space_id, $activity_id){
        $completed_activities = $this->getCompletedActivities($space_id);
        if(sizeof($completed_activities) == sizeof($this->activities) - 1){
            foreach($completed_activities as $activity){
                if($activity['id'] == $activity_id){
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMissionTranslations()
    {
        return $this->hasMany(MissionTranslations::className(), ['mission_id' => 'id']);
    }

    public function getChapter(){
        return Chapter::findOne(['mission_id' => $this->id]);
    }
}
