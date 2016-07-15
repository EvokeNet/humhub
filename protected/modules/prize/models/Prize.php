<?php

namespace app\modules\prize\models;

use Yii;

/**
 * This is the model class for table `prizes`
 *
 * @property integer $id
 * @property string  $string
 */
 class Prize extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'prizes';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         ['name', 'required'],
         ['name', 'string', 'max' => 256],
         ['quantity', 'integer', 'min' => 0],
         ['week_of', 'date', 'format' => 'yy-MM-dd'],
         ['weight', 'integer', 'min' => 0]
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'id' => Yii::t('PrizeModule.base', 'ID'),
          'name' => Yii::t('PrizeModule.base', 'Name'),
          'week_of' => Yii::t('PrizeModule.base', 'Week of'),
          'weight' => Yii::t('PrizeModule.base', 'Weight'),
          'quantity' => Yii::t('PrizeModule.base', 'Quantity')
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
