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
use humhub\modules\user\models\Setting;
use app\modules\missions\models\EvidenceTags;
use humhub\modules\missions\controllers\AlertController;

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

    public function getTags(){
        return EvidenceTags::find(['user_id' => $this->user_id, 'evidence_id' => $this->evidence_id])->all();
    }

    public function beforeSave($insert){
        $this->content->user_id = $this->user_id;
        $this->content->object_model = Votes::classname();
        $this->content->object_id = $this->id;
        $this->content->visibility = \humhub\modules\content\models\Content::VISIBILITY_PUBLIC;
        return parent::beforeSave($insert);
    }

    public static function getTagCount(){
        $user = Yii::$app->user->getIdentity();

        return (new \yii\db\Query())
        ->select(['count(distinct evidence_id) as evidence_count'])
        ->from('evidence_tags as et')
        ->where(['user_id' => $user->id])
        ->one()['evidence_count'];
    }

    public function checkFiveTaggedEvidencesReward(){

        $user = Yii::$app->user->getIdentity();

        $tag_count = Votes::getTagCount();

        if($tag_count % 5 == 0 && $tag_count >= 5){
            $wallet = Wallet::find()->where(['owner_id' => $user->id])->one();
            $wallet->addCoin(1);
            $wallet->save();
            AlertController::createAlert(Yii::t('MissionsModule.base', "Reward"), Yii::t('MissionsModule.base', 'You\'ve received an extra evocoin for the last 5 evidences you\'ve tagged'));
            return true;
        }
        return false;
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


        // $enabled_review_notification_emails = Setting::Get($author->id,'enabled_review_notification_emails', 'Missions', 0);

        // if($enabled_review_notification_emails == 1){
        //    Yii::$app->mailer->compose('ReviewEvidence', [
        //     'user' => $author,
        //     'evidence_link' => $evidence->content->id
        //     ])
        //     ->setFrom([\humhub\models\Setting::Get('systemEmailAddress', 'mailing') => \humhub\models\Setting::Get('systemEmailName', 'mailing')])
        //     ->setTo($author->email)
        //     ->setSubject(Yii::t('MissionsModule.base', 'Evidence Reviewed'))
        //     //->setTextBody('Plain text content')
        //     //->setHtmlBody('<b>Your evidence was reviewed</b>')
        //     ->send();
        // }

        return parent::afterSave($insert, $changedAttributes);

    }

    public function getReviewCountByUsers($reviewer_id, $author_id) {
      $query = (new \yii\db\Query())
      ->select(['count(distinct v.id) as vote_count'])
      ->from('evidence as e')
      ->join('LEFT JOIN', 'votes v', '`v`.`evidence_id`=`e`.`id`')
      ->where('e.created_by = '.$author_id)
      ->andWhere('v.user_id = '.$reviewer_id)
      ->one();

      return $query['vote_count'];
    }

    public function getUrl(){
        $evidence = Evidence::findOne($this->evidence_id);
        return $evidence->content->getUrl();
    }

    public static function getAverageRatingStarHint($average){
        if($average <= 1){
            return Yii::t('MissionsModule.base', 'Does not comply with the rubric');
        }elseif($average <= 2){
            return Yii::t('MissionsModule.base', 'Meets the required minimum');
        }elseif($average <= 3){
            return Yii::t('MissionsModule.base', 'Good');
        }elseif($average <= 4){
            return Yii::t('MissionsModule.base', 'Excellent');
        }elseif($average <= 5){
            return Yii::t('MissionsModule.base', 'Outstanding');
        }
    }

    public function getStarHint(){
        switch($this->value){
            case 1:
                return Yii::t('MissionsModule.base', 'Does not comply with the rubric');
                break;
            case 2:
                return Yii::t('MissionsModule.base', 'Meets the required minimum');
                break;
            case 3:
                return Yii::t('MissionsModule.base', 'Good');
                break;
            case 4:
                return Yii::t('MissionsModule.base', 'Excellent');
                break;
            case 5:
                return Yii::t('MissionsModule.base', 'Outstanding');
                break;
        }
        return null;
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

        //remove tags
        $tags = EvidenceTags::find(['user_id' => $this->user_id, 'evidence_id' => $this->evidence_id])->all();
        foreach($tags as $tag){
            $tag->delete();
        }

        return parent::beforeDelete();
    }


}
