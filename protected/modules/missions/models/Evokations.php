<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "evokations".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $youtube_url
 * @property string $gdrive_url
 * @property integer $mission_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Missions $mission
 */
class Evokations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evokations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'youtube_url', 'gdrive_url', 'mission_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['description', 'youtube_url', 'gdrive_url'], 'string'],
            [['mission_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 120],
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
            'youtube_url' => Yii::t('app', 'Youtube Url'),
            'gdrive_url' => Yii::t('app', 'Gdrive Url'),
            'mission_id' => Yii::t('app', 'Mission ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMission()
    {
        return $this->hasOne(Missions::className(), ['id' => 'mission_id']);
    }
}
