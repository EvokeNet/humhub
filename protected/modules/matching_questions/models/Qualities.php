<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "qualities".
 *
 * @property integer $id
 * @property string $name
 * @property string $short_name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property string $image
 *
 * @property MatchingAnswers[] $matchingAnswers
 * @property QualityPowers[] $qualityPowers
 * @property QualityTranslations[] $qualityTranslations
 * @property SuperheroIdentities[] $superheroIdentities
 * @property SuperheroIdentities[] $superheroIdentities0
 * @property UserQualities[] $userQualities
 */
class Qualities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qualities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short_name', 'description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'short_name', 'description'], 'string', 'max' => 255],
            //[['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MatchingModule.base', 'ID'),
            'name' => Yii::t('MatchingModule.base', 'Name'),
            'short_name' => Yii::t('MatchingModule.base', 'Short Name'),
            'description' => Yii::t('MatchingModule.base', 'Description'),
            'created_at' => Yii::t('MatchingModule.base', 'Created At'),
            'updated_at' => Yii::t('MatchingModule.base', 'Updated At'),
            'image' => Yii::t('MatchingModule.base', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingAnswers()
    {
        return $this->hasMany(MatchingAnswers::className(), ['quality_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQualityPowers()
    {
        return $this->hasMany(QualityPowers::className(), ['quality_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQualityTranslations()
    {
        return $this->hasMany(QualityTranslations::className(), ['quality_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperheroIdentities()
    {
        return $this->hasMany(SuperheroIdentities::className(), ['quality_1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperheroIdentities0()
    {
        return $this->hasMany(SuperheroIdentities::className(), ['quality_2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserQualities()
    {
        return $this->hasMany(UserQualities::className(), ['quality_id' => 'id']);
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
}
