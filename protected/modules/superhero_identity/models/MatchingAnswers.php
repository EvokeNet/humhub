<?php

namespace app\modules\superhero_identity\models;

use Yii;

/**
 * This is the model class for table "matching_answers".
 *
 * @property integer $id
 * @property integer $matching_question_id
 * @property string $description
 * @property integer $quality_id
 * @property string $created
 * @property string $modified
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


    public function relations()
    {
        return array(
            'matching_question' => array(self::BELONGS_TO, 'MatchingQuestions', 'matching_question_id'),
            'quality' => array(self::BELONGS_TO, 'Qualities', 'quality_id'),
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['matching_question_id', 'description', 'quality_id', 'created', 'modified'], 'required'],
            [['matching_question_id', 'quality_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'matching_question_id' => Yii::t('app', 'Matching Question ID'),
            'description' => Yii::t('app', 'Description'),
            'quality_id' => Yii::t('app', 'Quality ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
}
