<?php

namespace app\modules\coin\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;

/**
 * This is the model class for table `wallet`
 *
 * @property integer  $id
 * @property integer  $owner_id
 * @property integer  $coin_id
 * @property integer  $amount
 * @property datetime $created_at
 * @property datetime $updated_at
 *
 * @property Owner $owner
 * @property Coin  $coin
 */
 class Wallet extends \yii\db\ActiveRecord
 {
   // adds timestamp behavior
   public function behaviors()
   {
     return [
       [
         'class' => TimestampBehavior::className(),
         'attributes' => [
           ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
           ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
         ],
         // use datetime instead of UNIX timestamp
         'value' => new Expression('NOW()'),
       ],
     ];
   }

   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'coin_wallet';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         [['owner_id', 'coin_id'], 'required'],
         [['owner_id', 'coin_id'], 'integer'],
         [['created_at', 'updated_at'], 'safe'],
         [['amount'], 'integer'],
         [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['owner_id' => 'id']],
         [['coin_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coin::className(), 'targetAttribute' => ['coin_id' => 'id']],
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'id' => Yii::t('CoinModule.base', 'ID'),
          'owner_id' => Yii::t('CoinModule.base', 'Owner ID'),
          'coin_id' => Yii::t('CoinModule.base', 'Coin ID'),
          'amount' => Yii::t('CoinModule.base', 'Amount'),
          'created_at' => Yii::t('CoinModule.base', 'Created At'),
          'updated_at' => Yii::t('CoinModule.base', 'Modified At'),
        ];
      }

      /**
       * returns the wallet's owner
       * @return \yii\db\ActiveQuery
       */
       public function getOwner()
       {
         return User::find()->where(['id' => $this->owner_id])->one();
       }

       /**
        * @return \yii\db\ActiveQuery
        */
        public function getCoin()
        {
          return Coin::find()->where(['id' => $this->coin_id])->one();
        }

        /**
         * get the amount of coins in wallet
         * @return integer
         */
         public function getAmount()
         {
           return $this->amount();
         }

        /**
         * adds coins to wallet
         *
         * @return boolean
         */
         public function addCoin($amount_to_add = 0)
         {
           $this->amount += $amount_to_add;
           $this->save();

           //track total coin created
           $coin = $this->getCoin();
           $coin->total_created += $amount_to_add;
           $coin->save();

           return true;
         }

         /**
          * removes coins from wallet
          * returns false if cannot deduct amount from wallet without
          * going negative
          *
          * @return boolean
          */
          public function removeCoin($amount_to_remove = 0)
          {
            if ($amount_to_remove <= $this->amount)
            {
              $this->amount -= $amount_to_remove;
              $this->save();
              return true;
            } else {
              return false;
            }

          }
 }
