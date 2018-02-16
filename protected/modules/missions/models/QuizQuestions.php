<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "quiz_questions".
 *
 * @property integer $id
 * @property string $question_headline
 * @property integer $power_id
 * @property integer $level_id
 *
 * @property QuizQuestionAnswers[] $quizQuestionAnswers
 * @property Powers $power
 * @property QuizUserAnswers[] $quizUserAnswers
 */
class QuizQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quiz_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_headline', 'power_id', 'level_id'], 'required'],
            [['question_headline'], 'string'],
            [['power_id', 'level_id'], 'integer'],
            [['power_id'], 'exist', 'skipOnError' => true, 'targetClass' => Powers::className(), 'targetAttribute' => ['power_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_headline' => 'Question Headline',
            'power_id' => 'Power ID',
            'level_id' => 'Level ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizQuestionAnswers()
    {
        return $this->hasMany(QuizQuestionAnswers::className(), ['quiz_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPower()
    {
        return $this->hasOne(Powers::className(), ['id' => 'power_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizUserAnswers()
    {
        return $this->hasMany(QuizUserAnswers::className(), ['quiz_question_id' => 'id']);
    }
}
