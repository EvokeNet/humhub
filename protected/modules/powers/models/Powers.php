<?php

namespace app\modules\powers\models;

use Yii;

/**
 * This is the model class for table "powers".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ActivityPowers[] $activityPowers
 * @property PowerTranslations[] $powerTranslations
 * @property QualityPowers[] $qualityPowers
 * @property UserPowers[] $userPowers
 */
class Powers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'powers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
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
            'id' => Yii::t('PowersModule.base', 'ID'),
            'title' => Yii::t('PowersModule.base', 'Title'),
            'description' => Yii::t('PowersModule.base', 'Description'),
            'created_at' => Yii::t('PowersModule.base', 'Created At'),
            'updated_at' => Yii::t('PowersModule.base', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityPowers()
    {
        return $this->hasMany(ActivityPowers::className(), ['power_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPowerTranslations()
    {
        return $this->hasMany(PowerTranslations::className(), ['power_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQualityPowers()
    {
        $powers = QualityPowers::find()->where(['power_id' => $this->id])->all();
        return $powers;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPowers()
    {
        return $this->hasMany(UserPowers::className(), ['power_id' => 'id']);
    }
}
