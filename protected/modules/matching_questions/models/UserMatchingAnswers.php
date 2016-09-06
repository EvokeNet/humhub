<?php

namespace app\modules\matching_questions\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use humhub\modules\content\components\ContentActiveRecord;
use app\modules\matching_questions\models\MatchingAnswers;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "user_matching_answers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $matching_question_id
 * @property integer $matching_answer_id
 * @property string $description
 * @property integer $order
 * @property string $created
 * @property string $modified
 *
 * @property User $user
 * @property UserMatchingAnswers $matchingAnswer
 * @property UserMatchingAnswers[] $userMatchingAnswers
 * @property MatchingQuestions $matchingQuestion
 */
class UserMatchingAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_matching_answers';
    }

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
    public function rules()
    {
        return [
            [['user_id', 'matching_answer_id'], 'required'],
            [['user_id', 'matching_answer_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['matching_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatchingAnswers::className(), 'targetAttribute' => ['matching_answer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MatchingModule.base', 'ID'),
            'user_id' => Yii::t('MatchingModule.base', 'User ID'),
            'matching_answer_id' => Yii::t('MatchingModule.base', 'Matching Answer ID'),
            'created' => Yii::t('MatchingModule.base', 'Created'),
            'modified' => Yii::t('MatchingModule.base', 'Modified'),
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
    public function getMatchingAnswer()
    {
        return $this->hasOne(UserMatchingAnswers::className(), ['id' => 'matching_answer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMatchingAnswers()
    {
        return $this->hasMany(UserMatchingAnswers::className(), ['matching_answer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingQuestion()
    {
        return $this->matchingAnswer->matchingQuestion;
    }
}
