<?php

namespace app\modules\marketpalce\models;

use Yii;

/**
 * This is the model class for table `products`
 *
 * @property integer $id
 * @property string  $string
 */
 class Product extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'products';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         ['name', 'required'],
         ['name', 'string', 'max' => 256],
         ['quantity', 'integer'],
         ['week_of', 'date', 'format' => 'yyyy-MM-dd'],
         ['weight', 'integer', 'min' => 0],
         ['description', 'string'],
         ['image', 'string', 'max' => 256]
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
          'quantity' => Yii::t('PrizeModule.base', 'Quantity'),
          'description' => Yii::t('PrizeModule.base', 'Description'),
          'image' => Yii::t('PrizeModule.base', "Image"),
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
