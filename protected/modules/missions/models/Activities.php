<?php

namespace humhub\modules\missions\models;

use Yii;

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
 *
 * @property Missions $mission
 * @property ActivityTranslations[] $activityTranslations
 */
class Activities extends \yii\db\ActiveRecord
{
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
            [['title', 'description'], 'required'],
            [['description', 'id_code'], 'string'],
            [['mission_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['mission_id'], 'exist', 'skipOnError' => true, 'targetClass' => Missions::className(), 'targetAttribute' => ['mission_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'mission_id' => Yii::t('app', 'Mission ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'id_code' => Yii::t('app', 'ID Code'),
        ];
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
    public function getActivityTranslations()
    {
        return $this->hasMany(ActivityTranslations::className(), ['activity_id' => 'id']);
    }
}
