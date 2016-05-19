<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "user_matching_answers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $matching_question_id
 * @property integer $matching_aswer_id
 * @property string $description
 * @property integer $order
 * @property string $created
 * @property string $modified
 *
 * @property User $user
 * @property UserMatchingAnswers $matchingAswer
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'matching_question_id', 'matching_aswer_id', 'description', 'order', 'created', 'modified'], 'required'],
            [['user_id', 'matching_question_id', 'matching_aswer_id', 'order'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['matching_aswer_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserMatchingAnswers::className(), 'targetAttribute' => ['matching_aswer_id' => 'id']],
            [['matching_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatchingQuestions::className(), 'targetAttribute' => ['matching_question_id' => 'id']],
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
            'matching_question_id' => Yii::t('app', 'Matching Question ID'),
            'matching_aswer_id' => Yii::t('app', 'Matching Aswer ID'),
            'description' => Yii::t('app', 'Description'),
            'order' => Yii::t('app', 'Order'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
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
    public function getMatchingAswer()
    {
        return $this->hasOne(UserMatchingAnswers::className(), ['id' => 'matching_aswer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMatchingAnswers()
    {
        return $this->hasMany(UserMatchingAnswers::className(), ['matching_aswer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingQuestion()
    {
        return $this->hasOne(MatchingQuestions::className(), ['id' => 'matching_question_id']);
    }
}
