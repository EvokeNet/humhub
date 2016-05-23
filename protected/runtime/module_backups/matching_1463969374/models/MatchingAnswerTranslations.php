<?php

namespace app\modules\matching_questions\models;

use Yii;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "matching_answer_translations".
 *
 * @property integer $id
 * @property integer $matching_answer_id
 * @property integer $language_id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Languages $language
 * @property MatchingAnswers $matchingAnswer
 */
class MatchingAnswerTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matching_answer_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matching_answer_id', 'language_id', 'description'], 'required'],
            [['matching_answer_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['matching_answer_id'], 'exist', 'skipOnError' => true, 'targetClass' => MatchingAnswers::className(), 'targetAttribute' => ['matching_answer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'matching_answer_id' => Yii::t('app', 'Matching Answer ID'),
            'language_id' => Yii::t('app', 'Language ID'),
            'description' => Yii::t('app', 'Description'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
    public function getMatchingAnswer()
    {
        return $this->hasOne(MatchingAnswers::className(), ['id' => 'matching_answer_id']);
    }
}
