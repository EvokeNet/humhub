<?php

namespace app\modules\matching_questions\models;

use Yii;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "quality_translations".
 *
 * @property integer $id
 * @property integer $quality_id
 * @property integer $language_id
 * @property string $name
 * @property string $short_name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Languages $language
 * @property Qualities $quality
 */
class QualityTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quality_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quality_id', 'language_id', 'name', 'short_name', 'description'], 'required'],
            [['quality_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'short_name'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['quality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qualities::className(), 'targetAttribute' => ['quality_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'quality_id' => Yii::t('app', 'Quality ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'name' => Yii::t('app', 'Name'),
            'short_name' => Yii::t('app', 'Short Name'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
    public function getQuality()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_id']);
    }
}
