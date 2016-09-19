<?php

namespace app\modules\stats\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "stats_activities".
 *
 * @property integer $id
 * @property integer $activities_id
 * @property integer $mission_id
 * @property string $name
 * @property string $mission_name
 * @property integer $total_evidences
 * @property integer $number_evidences
 * @property double $avg_evidences
 * @property string $created_at
 * @property string $updated_at
 */
class StatsActivities extends \yii\db\ActiveRecord
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
        return 'stats_activities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activities_id', 'mission_id', 'total_evidences', 'number_evidences'], 'integer'],
            [['name', 'mission_name'], 'string'],
            [['avg_evidences'], 'number'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activities_id' => Yii::t('app', 'Activities ID'),
            'mission_id' => Yii::t('app', 'Mission ID'),
            'name' => Yii::t('app', 'Name'),
            'mission_name' => Yii::t('app', 'Mission Name'),
            'total_evidences' => Yii::t('app', 'Total Evidences'),
            'number_evidences' => Yii::t('app', 'Number Evidences'),
            'avg_evidences' => Yii::t('app', 'Avg Evidences'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
