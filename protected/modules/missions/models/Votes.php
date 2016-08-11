<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\notification\models\Notification;
use app\modules\missions\models\Evidence;
use humhub\modules\content\components\ContentActiveRecord;

/**
 * This is the model class for table "votes".
 *
 * @property integer $id
 * @property integer $activity_id
 * @property integer $evidence_id
 * @property integer $power_id
 * @property integer $flag
 * @property integer $value
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Activities $activity
 * @property Evidence $evidence
 * @property Powers $power
 */
class Votes extends ContentActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'votes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'evidence_id', 'user_id', 'flag', 'value'], 'required'],
            [['activity_id', 'evidence_id', 'user_id', 'flag', 'value'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['comment'], 'string'],
            [['activity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activity_id' => 'id']],
            [['evidence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Evidence::className(), 'targetAttribute' => ['evidence_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'activity_id' => Yii::t('app', 'Activity ID'),
            'evidence_id' => Yii::t('app', 'Evidence ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'flag' => Yii::t('app', 'Flag'),
            'value' => Yii::t('app', 'Value'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'comment' => Yii::t('MissionsModule.model', 'Comment')
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidence()
    {
        return $this->hasOne(Evidence::className(), ['id' => 'evidence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }    

    public function beforeSave($insert){
        $this->content->user_id = $this->user_id;
        $this->content->object_model = Votes::classname();
        $this->content->object_id = $this->id;
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {

        if ($insert && !$this->flag) {
            $evidence = Evidence::findOne($this->evidence_id);
            $author = User::findOne($this->evidence->content->user_id);

            $notification = new \humhub\modules\missions\notifications\RejectedEvidence();
            $notification->source = $this;

            if(Yii::$app->user->getIdentity()->group->name == "Mentors"){
                $notification->originator = Yii::$app->user->getIdentity();  
            }
            $notification->send($author);
        }else if($insert) {
            $evidence = Evidence::findOne($this->evidence_id);
            $author = User::findOne($this->evidence->content->user_id);

            $notification = new \humhub\modules\missions\notifications\ReviewedEvidence();
            $notification->source = $this;
            if(Yii::$app->user->getIdentity()->group->name == "Mentors"){
                $notification->originator = Yii::$app->user->getIdentity();  
            }
            $notification->send($author);
        }

        return parent::afterSave($insert, $changedAttributes);

    }   

    public function getUrl(){
        $evidence = Evidence::findOne($this->evidence_id);
        return $evidence->content->getUrl();
    }

    public function beforeDelete()
    {
        $notifications = Notification::findAll(['source_pk' => $this->id, 'source_class' => Votes::classname()]);

        foreach($notifications as $notification){
            $notification->delete();
        }

        return parent::beforeDelete();
    }  


}
