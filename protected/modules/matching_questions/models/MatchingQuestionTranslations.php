<?php

namespace app\modules\matching_questions\models;

use Yii;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "matching_question_translations".
 *
 * @property integer $id
 * @property integer $matching_question_id
 * @property integer $language_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Languages $language
 * @property MatchingQuestions $matchingQuestion
 */
class MatchingQuestionTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matching_question_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language_id', 'description'], 'required'],
            [['matching_question_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['matching_question_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatchingQuestions::className(), 'targetAttribute' => ['matching_question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MatchingModule.base', 'ID'),
            'matching_question_id' => Yii::t('MatchingModule.base', 'Matching Question ID'),
            'language_id' => Yii::t('MatchingModule.base', 'Language ID'),
            'description' => Yii::t('MatchingModule.base', 'Description'),
            'created_at' => Yii::t('MatchingModule.base', 'Created At'),
            'updated_at' => Yii::t('MatchingModule.base', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatchingQuestion()
    {
        return $this->hasOne(MatchingQuestions::className(), ['id' => 'matching_question_id']);
    }
}
