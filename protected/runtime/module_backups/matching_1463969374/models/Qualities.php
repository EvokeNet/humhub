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
 * @property string $created
 * @property string $modified
 *
 * @property QualityTranslations[] $qualityTranslations
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
            [['created', 'modified'], 'safe'],
            [['name', 'short_name', 'description'], 'string', 'max' => 255],
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
            'short_name' => Yii::t('app', 'Short Name'),
            'description' => Yii::t('app', 'Description'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQualityTranslations()
    {
        return $this->hasMany(QualityTranslations::className(), ['quality_id' => 'id']);
    }
}
