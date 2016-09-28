<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\user\models\User;
use humhub\modules\notification\models\Notification;
use app\modules\missions\models\Evidence;
use app\modules\coin\models\Wallet;
use humhub\modules\content\components\ContentActiveRecord;
use app\modules\missions\models\Activities;
use app\modules\powers\models\UserPowers;
use humhub\modules\admin\models\forms\MailingSettingsForm;

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

        $evidence = Evidence::findOne($this->evidence_id);
        $author = User::findOne($this->evidence->content->user_id);

        if ($insert && !$this->flag) {

            $notification = new \humhub\modules\missions\notifications\RejectedEvidence();
            $notification->source = $this;

            if(Yii::$app->user->getIdentity()->group->name == "Mentors"){
                $notification->originator = Yii::$app->user->getIdentity();
            }
            $notification->send($author);
        }else if($insert) {

            $notification = new \humhub\modules\missions\notifications\ReviewedEvidence();
            $notification->source = $this;
            if(Yii::$app->user->getIdentity()->group->name == "Mentors"){
                $notification->originator = Yii::$app->user->getIdentity();
            }
            $notification->send($author);
        }

        Yii::$app->mailer->compose('ReviewEvidence', [
            'user' => $author,
            'evidence_link' => $evidence->content->id,
            "message" => 'hey'
        ])
        ->setFrom([\humhub\models\Setting::Get('systemEmailAddress', 'mailing') => \humhub\models\Setting::Get('systemEmailName', 'mailing')])
        ->setTo($author->email)
        ->setSubject(Yii::t('MissionsModule.base', 'Evidence Reviewed'))
        ->setTextBody('Plain text content')
        ->setHtmlBody('<b>Your evidence was reviewed</b>')
        ->send();

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

        $wallet = Wallet::find()->where(['owner_id' => $this->user_id])->one();
        
        if(empty($this->comment)){
            $coins = 1;
        }else{
            $coins = 5;
        }

        //Remove reviewer coins
        
        if(isset($wallet)){
            $wallet->removeCoin($coins);
            $wallet->save();
        }

        //Remove evidence owner power points

        $user = User::findOne($this->evidence->created_by);
        $reviewer = User::findOne($this->user_id);

        $value = $this->value;

        if($this->flag){
            if (isset($reviewer) && $reviewer->group->name == "Mentors") {
                $value *= 2;
            }
        }

        if(isset($user)){
            //REMOVE USER POWER POINT
            $activity_power = Activities::findOne($this->activity_id)->getPrimaryPowers()[0];
            if(isset($activity_power)){
                UserPowers::removePowerPoint($activity_power->getPower(), $user, $value);
            }
            
        }

        return parent::beforeDelete();
    }


}
