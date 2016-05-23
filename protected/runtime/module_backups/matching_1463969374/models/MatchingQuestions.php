<?php

namespace app\modules\matching_questions\models;

use Yii;

use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "matching_questions".
 *
 * @property integer $id
 * @property string $description
 * @property string $type
 * @property string $created
 * @property string $modified
 * @property string $id_code
 *
 * @property MatchingAnswers[] $matchingAnswers
 * @property MatchingQuestionTranslations[] $matchingQuestionTranslations
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
            [['created', 'modified'], 'safe'],
            [['id_code'], 'string'],
            [['description', 'type'], 'string', 'max' => 255],
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
            'type' => Yii::t('app', 'Type'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
            'id_code' => Yii::t('app', 'ID Code'),
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
}
