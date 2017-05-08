<?php

namespace app\modules\novel\models;

use Yii;
use app\modules\missions\models\Missions;

/**
 * This is the model class for table "chapter".
 *
 * @property integer $id
 * @property integer $number
 * @property integer $mission_id
 *
 * @property Missions $mission
 * @property Novel[] $novels
 */
class Chapter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number', 'mission_id'], 'integer'],
            [['mission_id'], 'exist', 'skipOnError' => true, 'targetClass' => Missions::className(), 'targetAttribute' => ['mission_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'mission_id' => 'Mission ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMission()
    {
        return $this->hasOne(Missions::className(), ['id' => 'mission_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNovels()
    {
        return $this->hasMany(Novel::className(), ['chapter_id' => 'id']);
    }
}
