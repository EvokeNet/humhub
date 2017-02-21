<?php

namespace app\modules\missions\models;

use Yii;
use app\modules\missions\models\Tags;
use app\modules\missions\models\Evidence;
use app\modules\matching_questions\models\User;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "evidence_tags".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $evidence_id
 * @property integer $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property Evidence $evidence
 * @property Tags $tag
 * @property User $user
 */
class EvidenceTags extends \yii\db\ActiveRecord
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
        return 'evidence_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'evidence_id', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['tag_id', 'evidence_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['evidence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Evidence::className(), 'targetAttribute' => ['evidence_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tags::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
            'evidence_id' => Yii::t('app', 'Evidence ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidence()
    {
        return $this->hasOne(Evidence::className(), ['id' => 'evidence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }
}
