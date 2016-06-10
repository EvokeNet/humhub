<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "skill_translations".
 *
 * @property integer $id
 * @property integer $skill_id
 * @property string $title
 * @property string $develop
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Skills $skill
 */
class SkillTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skill_id', 'title'], 'required'],
            [['skill_id'], 'integer'],
            [['develop', 'description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Skills::className(), 'targetAttribute' => ['skill_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MissionsModule.model', 'ID'),
            'skill_id' => Yii::t('MissionsModule.model', 'Skill ID'),
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
    public function getSkill()
    {
        return $this->hasOne(Skills::className(), ['id' => 'skill_id']);
    }
}
