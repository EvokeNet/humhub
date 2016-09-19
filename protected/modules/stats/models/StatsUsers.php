<?php

namespace app\modules\stats\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "stats_users".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property integer $number_evocoins
 * @property integer $number_followers
 * @property integer $number_followees
 * @property integer $number_reviews
 * @property integer $number_evidences
 * @property string $user_or_mentor
 * @property integer $read_novel
 * @property string $created_at
 * @property string $updated_at
 */
class StatsUsers extends \yii\db\ActiveRecord
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
        return 'stats_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'number_evocoins', 'number_followers', 'number_followees', 'number_reviews', 'number_evidences', 'read_novel'], 'integer'],
            [['username'], 'string'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_or_mentor'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'username' => Yii::t('app', 'Username'),
            'number_evocoins' => Yii::t('app', 'Number Evocoins'),
            'number_followers' => Yii::t('app', 'Number Followers'),
            'number_followees' => Yii::t('app', 'Number Followees'),
            'number_reviews' => Yii::t('app', 'Number Reviews'),
            'number_evidences' => Yii::t('app', 'Number Evidences'),
            'user_or_mentor' => Yii::t('app', 'User Or Mentor'),
            'read_novel' => Yii::t('app', 'Read Novel'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
