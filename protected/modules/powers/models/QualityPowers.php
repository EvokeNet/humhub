<?php

namespace app\modules\powers\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

use app\modules\matching_questions\models\Qualities;

/**
 * This is the model class for table "quality_powers".
 *
 * @property integer $id
 * @property integer $quality_id
 * @property integer $power_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Qualities $quality
 * @property Powers $power
 */
class QualityPowers extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
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
            [['created_at', 'updated_at'], 'safe'],
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
            'id' => Yii::t('PowersModule.base', 'ID'),
            'quality_id' => Yii::t('PowersModule.base', 'Quality ID'),
            'power_id' => Yii::t('PowersModule.base', 'Power ID'),
            'created_at' => Yii::t('PowersModule.base', 'Created At'),
            'updated_at' => Yii::t('PowersModule.base', 'Modified At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_id']);
    }

    public function getQualityObject(){
        return  Qualities::findOne($this->quality_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPower()
    {
        $power = Powers::findOne($this->power_id);
        return $power;
    }
}
