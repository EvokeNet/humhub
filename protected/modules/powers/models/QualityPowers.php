<?php

namespace app\modules\powers\models;

use Yii;

use app\modules\matching_questions\models\Qualities;

/**
 * This is the model class for table "quality_powers".
 *
 * @property integer $id
 * @property integer $quality_id
 * @property integer $power_id
 * @property string $created_at
 * @property string $modified_at
 *
 * @property Qualities $quality
 * @property Powers $power
 */
class QualityPowers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quality_powers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['quality_id', 'power_id'], 'required'],
            [['quality_id', 'power_id'], 'integer'],
            [['created_at', 'modified_at'], 'safe'],
            [['quality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qualities::className(), 'targetAttribute' => ['quality_id' => 'id']],
            [['power_id'], 'exist', 'skipOnError' => true, 'targetClass' => Powers::className(), 'targetAttribute' => ['power_id' => 'id']],
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
            'power_id' => Yii::t('app', 'Power ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'modified_at' => Yii::t('app', 'Modified At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPower()
    {
        return $this->hasOne(Powers::className(), ['id' => 'power_id']);
    }
}
