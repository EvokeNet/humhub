<?php

namespace app\modules\superhero_identity\models;

use Yii;

/**
 * This is the model class for table "matching_questions".
 *
 * @property integer $id
 * @property string $description
 * @property string $type
 * @property string $created
 * @property string $modified
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
            [['description', 'type', 'created', 'modified'], 'required'],
            [['created', 'modified'], 'safe'],
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
        ];
    }
}
