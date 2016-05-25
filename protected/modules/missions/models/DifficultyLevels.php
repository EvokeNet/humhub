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
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'points' => Yii::t('app', 'Points'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Modified At'),
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
