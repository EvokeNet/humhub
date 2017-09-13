<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "evoke_log".
 *
 * @property integer $id
 * @property string $message
 * @property string $time
 */
class EvokeLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evoke_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'time'], 'required'],
            [['message'], 'string'],
            [['time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'time' => 'Time',
        ];
    }

    public static function log($message){
        $evoke_log = new EvokeLog();
        if(is_array($message)){
            $message = json_encode($message);
        }
        $evoke_log->message = $message;
        $evoke_log->time = new Expression('NOW()');
        $evoke_log->save();
    }
}
