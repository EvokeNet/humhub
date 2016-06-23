<?php

namespace app\modules\coin\models;

use Yii;
use app\modules\coin\models\Wallet;
use humhub\modules\user\models\User;

/**
 * This is the model class for table `coin`
 *
 * @property integer $id
 * @property string  $string
 */
 class Coin extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'coin';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         ['name', 'required'],
         ['name', 'string', 'max' => 256],
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'id' => Yii::t('CoinModule.base', 'ID'),
          'name' => Yii::t('CoinModule.base', 'Name')
        ];
      }

      /**
       * @return string
       */
       public function getName()
       {
         return $this->name;
       }

       /**
        * Init wallets after save
        */
       public function afterSave($insert, $changedAttributes)
       {
         parent::afterSave($insert, $changedAttributes);

           $coin_id = $this->id;
           $users = User::find()->all();

           foreach ($users as $user) {

             // check if user has wallet
             $wallet = Wallet::find()->where(['owner_id' => $user->id, 'coin_id' => $coin_id])->one();

             if (is_null($wallet)) {
               $wallet = new Wallet();

               $wallet->coin_id  = $coin_id;
               $wallet->owner_id = $user->id;
               $wallet->amount   = 0;

               $wallet->save();
             }
           }
       }
 }
