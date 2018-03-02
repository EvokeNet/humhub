<?php

namespace app\modules\missions\models;

use Yii;

/**
 * This is the model class for table "quiz_question_answers".
 *
 * @property integer $id
 * @property string $answer_headline
 * @property integer $quiz_question_id
 *
 * @property QuizQuestions $quizQuestion
 * @property QuizUserAnswers[] $quizUserAnswers
 */
class QuizQuestionAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */ 
    public static function tableName()
    {
        return 'quiz_question_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer_headline', 'quiz_question_id'], 'required'],
            [['answer_headline'], 'string'],
            [['quiz_question_id'], 'integer'],
            [['right_answer'], 'integer'],
            [['quiz_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizQuestions::className(), 'targetAttribute' => ['quiz_question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'answer_headline' => 'Answer Headline',
            'quiz_question_id' => 'Quiz Question ID',
            'right_answer' => 'Right Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizQuestion()
    {
        return $this->hasOne(QuizQuestions::className(), ['id' => 'quiz_question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizUserAnswers()
    {
        return $this->hasMany(QuizUserAnswers::className(), ['quiz_question_answer_id' => 'id']);
    }
}
