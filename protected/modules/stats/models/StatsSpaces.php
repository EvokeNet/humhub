<?php

namespace app\modules\stats\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "stats_spaces".
 *
 * @property integer $id
 * @property integer $space_id
 * @property string $name
 * @property integer $total_users
 * @property integer $total_evidences
 * @property integer $total_reviews
 * @property string $created_at
 * @property string $updated_at
 */
class StatsSpaces extends \yii\db\ActiveRecord
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
        return 'stats_spaces';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['space_id', 'total_users', 'total_evidences', 'total_reviews'], 'integer'],
            [['name'], 'string'],
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
            'space_id' => Yii::t('app', 'Space ID'),
            'name' => Yii::t('app', 'Name'),
            'total_users' => Yii::t('app', 'Total Users'),
            'total_evidences' => Yii::t('app', 'Total Evidences'),
            'total_reviews' => Yii::t('app', 'Total Reviews'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
