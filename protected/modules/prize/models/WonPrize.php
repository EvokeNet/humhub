<?php

namespace app\modules\prize\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;
use app\modules\prize\models\Prize;

/**
 * This is the model class for table `wallet`
 *
 * @property integer  $id
 * @property integer  $user_id
 * @property integer  $prize_id

 */
 class WonPrize extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'won_prizes';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         [['user_id', 'prize_id'], 'required'],
         [['user_id', 'prize_id'], 'integer'],
         [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
         [['prize_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prize::className(), 'targetAttribute' => ['prize_id' => 'id']],
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'id' => Yii::t('CoinModule.base', 'ID'),
          'user_id' => Yii::t('CoinModule.base', 'Owner ID'),
          'prize_id' => Yii::t('CoinModule.base', 'Coin ID'),
        ];
      }

      public function getUser() {
        return User::find()->where(['id' => $this->user_id])->one();
      }

      public function getPrize() {
        return Prize::find()->where(['id' => $this->prize_id])->one();
      }

      public function getPrizeName() {
        return Prize::find()->where(['id' => $this->prize_id])->one()->name;
      }

 }
