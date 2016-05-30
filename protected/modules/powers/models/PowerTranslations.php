<?php

namespace app\modules\powers\models;

use Yii;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "power_translations".
 *
 * @property integer $id
 * @property integer $power_id
 * @property integer $language_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Languages $language
 */
class PowerTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'power_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['power_id', 'language_id', 'title', 'description'], 'required'],
            [['power_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'power_id' => Yii::t('app', 'Power ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'title' => Yii::t('app', 'Title'),
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
}
