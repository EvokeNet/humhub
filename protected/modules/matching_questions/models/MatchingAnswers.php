<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "matching_answers".
 *
 * @property integer $id
 * @property string $description
 * @property integer $matching_question_id
 * @property integer $quality_id
 * @property string $created_at
 * @property string $updated_at
 */
class MatchingAnswers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matching_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'matching_question_id', 'quality_id'], 'required'],
            [['description'], 'string'],
            [['matching_question_id', 'quality_id'], 'integer'],
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
            'description' => Yii::t('app', 'Description'),
            'matching_question_id' => Yii::t('app', 'Matching Question ID'),
            'quality_id' => Yii::t('app', 'Quality ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingAnswerTranslations()
    {
        return $this->hasMany(MatchingAnswerTranslations::className(), ['matching_answer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingQuestion()
    {
        return $this->hasOne(MatchingQuestions::className(), ['id' => 'matching_question_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_id']);
    }
}
