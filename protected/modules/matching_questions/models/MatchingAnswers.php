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
 *
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
            // [['description', 'matching_question_id', 'social_innovator_quality_id', 'created', 'modified'], 'required'],
            [['description'], 'required'],
            [['matching_question_id', 'social_innovator_quality_id'], 'integer'],
            [['created', 'modified'], 'safe'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingQuestion()
    {
        return $this->hasOne(MatchingQuestions::className(), ['id' => 'matching_question_id']);
    }
}
