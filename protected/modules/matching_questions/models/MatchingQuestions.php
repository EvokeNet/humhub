<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "matching_questions".
 *
 * @property integer $id
 * @property string $description
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property string $id_code
 *
 * @property MatchingAnswers[] $matchingAnswers
 * @property MatchingQuestionTranslations[] $matchingQuestionTranslations
 * @property UserMatchingAnswers[] $userMatchingAnswers
 */
class MatchingQuestions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matching_questions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'type'], 'required'],
            [['description', 'id_code'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MatchingModule.base', 'ID'),
            'description' => Yii::t('MatchingModule.base', 'Description'),
            'type' => Yii::t('MatchingModule.base', 'Type'),
            'created_at' => Yii::t('MatchingModule.base', 'Created At'),
            'updated_at' => Yii::t('MatchingModule.base', 'Updated At'),
            'id_code' => Yii::t('MatchingModule.base', 'Id Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingAnswers()
    {
        return $this->hasMany(MatchingAnswers::className(), ['matching_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingQuestionTranslations()
    {
        return $this->hasMany(MatchingQuestionTranslations::className(), ['matching_question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMatchingAnswers()
    {
        return $this->hasMany(UserMatchingAnswers::className(), ['matching_question_id' => 'id']);
    }
}
