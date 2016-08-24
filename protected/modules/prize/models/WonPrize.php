<?php

namespace app\modules\prize\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;

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

 }
