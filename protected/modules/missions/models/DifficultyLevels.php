<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "difficulty_levels".
 *
 * @property integer $id
 * @property string $title
 * @property integer $points
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Activities[] $activities
 */
class DifficultyLevels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'difficulty_levels';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'points'], 'required'],
            [['points'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 256],
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
            'points' => Yii::t('MissionsModule.model', 'Points'),
            'created_at' => Yii::t('MissionsModule.model', 'Created At'),
            'updated_at' => Yii::t('MissionsModule.model', 'Modified At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activities::className(), ['difficulty_level_id' => 'id']);
    }
}
