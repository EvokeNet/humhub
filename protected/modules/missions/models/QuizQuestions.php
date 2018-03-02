<?php

namespace app\modules\missions\models;
use app\modules\matching_questions\models\Qualities;

use Yii;

/**
 * This is the model class for table "quiz_questions".
 *
 * @property integer $id
 * @property string $question_headline
 * @property integer $quality_id
 * @property integer $level_id
 *
 * @property QuizQuestionAnswers[] $quizQuestionAnswers
 * @property Qualities $quality
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
            [['question_headline', 'quality_id', 'level_id'], 'required'],
            [['question_headline'], 'string'],
            [['quality_id', 'level_id'], 'integer'],
            [['quality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qualities::className(), 'targetAttribute' => ['quality_id' => 'id']],
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
            'quality_id' => 'Quality ID',
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

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getPower()
    // {
    //     return $this->hasOne(Powers::className(), ['id' => 'power_id']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuizUserAnswers()
    {
        return $this->hasMany(QuizUserAnswers::className(), ['quiz_question_id' => 'id']);
    }
}
