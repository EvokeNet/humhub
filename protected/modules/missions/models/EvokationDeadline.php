<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\modules\missions\models\DateTimeFunctions;

/**
 * This is the model class for table "evokation_deadline".
 *
 * @property integer $id
 * @property string $start_date
 * @property string $finish_date
 * @property string $created_at
 * @property string $updated_at
 */
class EvokationDeadline extends \yii\db\ActiveRecord
{

    const EVOKATION_DEADLINE = "evokation_deadline";
    const VOTING_DEADLINE = "voting_deadline";

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];{}
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evokation_deadline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'finish_date'], 'required'],
            [['start_date', 'finish_date', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start_date' => Yii::t('app', 'Start Date'),
            'finish_date' => Yii::t('app', 'Finish Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /*
    *   Finish date is the latest minute of the finish day.
    */
    public function getFinishDate(){
        $finish_date = date_create($this->finish_date);
        date_add($finish_date, date_interval_create_from_date_string('23 hours 59 minutes 59 seconds'));
        return date_format($finish_date, 'Y-m-d H:i:s');
    }

    public function hasEnded(){
        $finish_date = $this->getFinishDate();

        if(strtotime($finish_date) >= (strtotime(date('Y-m-d H:i:s')))){
            return false;
        }else{
            return true;
        }
    }

    public function hasStarted(){
        if(strtotime($this->start_date) > (strtotime(date('Y-m-d H:i:s')))){
            return false;
        }else{
            return true;
        }
    }

    public function isOccurring(){
        return ($this->hasStarted() && !$this->hasEnded());
    }

    public function willStartIn($days){
        $start_time = date($this->start_date);
        $second = date('Y-m-d H:i:s');

        $diff = new DateTimeFunctions($start_time, $second);

        if($diff->higher == 0){
            return true;
        }

        // sum 1, reason: (time set isn't exact: 59 minutes 59 seconds....)
        $local_hours = date('H') + 1;
        $days_diff = $diff->days;

        if($diff->hours + $local_hours >= 24){
            $days_diff += 1;
        }

        if($days_diff <= $days){
            return true;
        }

        return false;
    }

    public static function getEvokationDeadline(){
        return EvokationDeadline::findOne(['code' => EvokationDeadline::EVOKATION_DEADLINE]);
    }

    public static function createNewEvokationDeadline(){
        $deadline = new EvokationDeadline();
        $deadline->code = EvokationDeadLine::EVOKATION_DEADLINE;
        return $deadline;
    }

    public static function getVotingDeadline(){
        return EvokationDeadline::findOne(['code' => EvokationDeadline::VOTING_DEADLINE]);
    }

    public static function createNewVotingDeadline(){
        $deadline = new EvokationDeadline();
        $deadline->code = EvokationDeadLine::VOTING_DEADLINE;
        return $deadline;
    }
}
