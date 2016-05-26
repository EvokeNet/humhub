<?php

namespace app\modules\matching_questions\models;

use Yii;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "superhero_identity_translations".
 *
 * @property integer $id
 * @property integer $superhero_identity_id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property integer $language_id
 *
 * @property Languages $language
 * @property SuperheroIdentities $superheroIdentity
 */
class SuperheroIdentityTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'superhero_identity_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['superhero_identity_id', 'name', 'description', 'language_id'], 'required'],
            [['superhero_identity_id', 'language_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['superhero_identity_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuperheroIdentities::className(), 'targetAttribute' => ['superhero_identity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MatchingModule.base', 'ID'),
            'superhero_identity_id' => Yii::t('MatchingModule.base', 'Superhero Identity ID'),
            'name' => Yii::t('MatchingModule.base', 'Name'),
            'description' => Yii::t('MatchingModule.base', 'Description'),
            'created_at' => Yii::t('MatchingModule.base', 'Created At'),
            'updated_at' => Yii::t('MatchingModule.base', 'Updated At'),
            'language_id' => Yii::t('MatchingModule.base', 'Language ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperheroIdentity()
    {
        return $this->hasOne(SuperheroIdentities::className(), ['id' => 'superhero_identity_id']);
    }
}
