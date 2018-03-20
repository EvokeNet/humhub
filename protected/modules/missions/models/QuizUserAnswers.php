<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\user\models\User;
use app\modules\missions\models\QuizQuestions;
use app\modules\missions\models\QuizQuestionAnswers;

/**
 * This is the model class for table "quiz_user_answers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $quiz_question_id
 * @property integer $quiz_question_answer_id
 *
 * @property QuizQuestionAnswers $quizQuestionAnswer
 * @property QuizQuestions $quizQuestion
 * @property User $user
 */
class QuizUserAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quiz_user_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'quiz_question_id', 'quiz_question_answer_id'], 'required'],
            [['user_id', 'quiz_question_id', 'quiz_question_answer_id'], 'integer'],
            [['quiz_question_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizQuestionAnswers::className(), 'targetAttribute' => ['quiz_question_answer_id' => 'id']],
            [['quiz_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuizQuestions::className(), 'targetAttribute' => ['quiz_question_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'quiz_question_id' => 'Quiz Question ID',
            'quiz_question_answer_id' => 'Quiz Question Answer ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizQuestionAnswer()
    {
        return $this->hasOne(QuizQuestionAnswers::className(), ['id' => 'quiz_question_answer_id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
