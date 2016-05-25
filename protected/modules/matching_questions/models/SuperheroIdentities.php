<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "superhero_identities".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $quality_1
 * @property integer $quality_2
 * @property integer $primary_power
 * @property integer $secondary_power
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Qualities $quality2
 * @property Qualities $quality1
 * @property SuperheroIdentityTranslations[] $superheroIdentityTranslations
 * @property User[] $users
 */
class SuperheroIdentities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'superhero_identities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'quality_1', 'quality_2', 'primary_power', 'secondary_power'], 'required'],
            [['quality_1', 'quality_2', 'primary_power', 'secondary_power'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            [['quality_2'], 'exist', 'skipOnError' => true, 'targetClass' => Qualities::className(), 'targetAttribute' => ['quality_2' => 'id']],
            [['quality_1'], 'exist', 'skipOnError' => true, 'targetClass' => Qualities::className(), 'targetAttribute' => ['quality_1' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'quality_1' => Yii::t('app', 'Quality 1'),
            'quality_2' => Yii::t('app', 'Quality 2'),
            'primary_power' => Yii::t('app', 'Primary Power'),
            'secondary_power' => Yii::t('app', 'Secondary Power'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality2()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality1()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperheroIdentityTranslations()
    {
        return $this->hasMany(SuperheroIdentityTranslations::className(), ['superhero_identity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['superhero_identity_id' => 'id']);
    }
}
