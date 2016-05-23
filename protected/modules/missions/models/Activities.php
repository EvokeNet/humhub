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
 *
 * @property Missions $mission
 * @property ActivityTranslations[] $activityTranslations
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
            'id_code' => Yii::t('app', 'Id Code'),
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
