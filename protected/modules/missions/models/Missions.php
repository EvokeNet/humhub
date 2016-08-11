<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMissionTranslations()
    {
        return $this->hasMany(MissionTranslations::className(), ['mission_id' => 'id']);
    }
}
