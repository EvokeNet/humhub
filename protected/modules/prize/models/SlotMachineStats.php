<?php

namespace app\modules\prize\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;

/**
 * This is the model class for table `slot_machine_stats`
 *
 * @property integer  $id
 * @property integer  $user_id
 * @property integer  $prize_id

 */
 class SlotMachineStats extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'slot_machine_stats';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         [['uses', 'evocoin_created'], 'integer']
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
        ];
      }

 }
