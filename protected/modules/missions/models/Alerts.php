<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "alerts".
 *
 * @property integer $id
 * @property string $type
 * @property string $object_model
 * @property integer $object_id
 * @property integer $user_id
 *
 * @property User $user
 */
class Alerts extends \yii\db\ActiveRecord
{

    const REVIEW = 'review';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alerts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'object_model', 'object_id', 'user_id'], 'required'],
            [['object_id', 'user_id'], 'integer'],
            [['type', 'object_model'], 'string', 'max' => 120],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'object_model' => 'Object Model',
            'object_id' => 'Object ID',
            'user_id' => 'User ID',
        ];
    }

    public function createReviewNotification($user_id, $object_id){
        $alert = Alerts::findOne(['user_id' => $user_id]);

        if($alert){
            $alert->setType(Alerts::REVIEW, $object_id);
            $alert->save();
        }else{
            $alert = new Alerts;
            $alert->user_id = $user_id;
            $alert->setType(Alerts::REVIEW, $object_id);
            $alert->save();
        }

        return $alert;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function setType($type, $id){
        if($type == Alerts::REVIEW){
            $this->type = $type;
            $this->object_model = "app\modules\missions\models\Evidence"; 
            $this->object_id = $id;
        }   
    }

}
