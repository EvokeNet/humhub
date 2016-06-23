<?php

namespace app\modules\coin\models;

use Yii;

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
 }
