<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "matching_answers".
 *
 * @property integer $id
 * @property string $description
 * @property integer $matching_question_id
 * @property integer $social_innovator_quality_id
 * @property string $created
 * @property string $modified
 * @property string $id_code
 *
 * @property MatchingAnswerTranslations[] $matchingAnswerTranslations
 * @property MatchingQuestions $matchingQuestion
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
            [['description', 'matching_question_id', 'social_innovator_quality_id'], 'required'],
            [['matching_question_id', 'social_innovator_quality_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['id_code'], 'string'],
            [['description'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'matching_question_id' => Yii::t('app', 'Matching Question ID'),
            'social_innovator_quality_id' => Yii::t('app', 'Social Innovator Quality ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'id_code' => Yii::t('app', 'Id Code'),
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
}
