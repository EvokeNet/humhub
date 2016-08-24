<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "activity_categories".
 *
 * @property integer $id
 * @property integer $mission_id
 * @property integer $activity_id
 * @property integer $evokation_category_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Activities $activity
 * @property Missions $mission
 */
class ActivityCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mission_id', 'activity_id', 'evokation_category_id'], 'required'],
            [['mission_id', 'activity_id', 'evokation_category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
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
            'mission_id' => Yii::t('app', 'Mission ID'),
            'activity_id' => Yii::t('app', 'Activity ID'),
            'evokation_category_id' => Yii::t('app', 'Evokation Category ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMission()
    {
        return $this->hasOne(Missions::className(), ['id' => 'mission_id']);
    }
}
