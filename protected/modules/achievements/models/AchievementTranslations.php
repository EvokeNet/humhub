<?php

namespace app\modules\achievements\models;

use Yii;

/**
 * This is the model class for table "achievement_translations".
 *
 * @property integer $id
 * @property integer $achievement_id
 * @property string $title
 * @property string $description
 * @property integer $language_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Achievements $achievement
 */
class AchievementTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'achievement_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['achievement_id', 'title', 'language_id'], 'required'],
            [['achievement_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['achievement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Achievements::className(), 'targetAttribute' => ['achievement_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'achievement_id' => Yii::t('app', 'Achievement ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'language_id' => Yii::t('app', 'Language ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAchievement()
    {
        return $this->hasOne(Achievements::className(), ['id' => 'achievement_id']);
    }
}
