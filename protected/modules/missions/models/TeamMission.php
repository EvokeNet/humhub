<?php

namespace app\modules\missions\models;

use Yii;
use app\modules\missions\models\Missions;
use app\modules\teams\models\Team;

/**
 * This is the model class for table "team_mission".
 *
 * @property integer $space_id
 * @property integer $mission_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Missions $mission
 * @property Space $space
 */
class TeamMission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team_mission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['space_id', 'mission_id'], 'required'],
            [['space_id', 'mission_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['mission_id'], 'exist', 'skipOnError' => true, 'targetClass' => Missions::className(), 'targetAttribute' => ['mission_id' => 'id']],
            [['space_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['space_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'space_id' => 'Space ID',
            'mission_id' => 'Mission ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
    public function getSpace()
    {
        return $this->hasOne(Team::className(), ['id' => 'space_id']);
    }

    public static function isMissionCompleted($mission_id, $team_id){
        $mission_completion = TeamMission::findOne(['mission_id' => $mission_id, 'space_id' => $team_id]);
        if($mission_completion){
            return true;
        }
        return false;
    }
}
