<?php

namespace app\modules\achievements\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "user_achievements".
 *
 * @property integer $user_id
 * @property integer $achievement_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Achievements $achievement
 * @property User $user
 */
class UserAchievements extends \yii\db\ActiveRecord
{


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
        return 'user_achievements';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'achievement_id'], 'required'],
            [['user_id', 'achievement_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['achievement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Achievements::className(), 'targetAttribute' => ['achievement_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'achievement_id' => 'Achievement ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAchievement()
    {
        return $this->hasOne(Achievements::className(), ['id' => 'achievement_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * After Saving of user achievements, fire a notification
     *
     * @return type
     */
    public function afterSave($insert, $changedAttributes)
    {
        $user = User::findOne($this->user_id);

        if ($insert && $this->achievement->code === "quality_review") {
            $notification = new \humhub\modules\achievements\notifications\NewAchievement();
            $notification->source = $this->achievement;
            $notification->originator = Yii::$app->user->getIdentity();
            $notification->send($user);
        }

        return parent::afterSave($insert, $changedAttributes);

    }


}
