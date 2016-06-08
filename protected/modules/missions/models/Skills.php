<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "skills".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property string $title
 * @property string $develop
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property SkillTranslations[] $skillTranslations
 * @property Activities $activity
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'title'], 'required'],
            [['activity_id'], 'integer'],
            [['develop', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MissionsModule.model', 'ID'),
            'activity_id' => Yii::t('MissionsModule.model', 'Activity ID'),
            'title' => Yii::t('MissionsModule.model', 'Title'),
            'develop' => Yii::t('MissionsModule.model', 'Develop'),
            'description' => Yii::t('MissionsModule.model', 'Description'),
            'created_at' => Yii::t('MissionsModule.model', 'Created At'),
            'updated_at' => Yii::t('MissionsModule.model', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkillTranslations()
    {
        return $this->hasMany(SkillTranslations::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
    }
}
