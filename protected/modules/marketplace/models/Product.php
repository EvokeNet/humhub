<?php

namespace app\modules\marketplace\models;

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
         ['price', 'integer', 'min' => 0],
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
          'id' => Yii::t('MarketplaceModule.base', 'ID'),
          'name' => Yii::t('MarketplaceModule.base', 'Name'),
          'week_of' => Yii::t('MarketplaceModule.base', 'Week of'),
          'price' => Yii::t('MarketplaceModule.base', 'Price'),
          'quantity' => Yii::t('MarketplaceModule.base', 'Quantity'),
          'description' => Yii::t('MarketplaceModule.base', 'Description'),
          'image' => Yii::t('MarketplaceModule.base', "Image"),
        ];
      }

      /**
       * @return string
       */
       public function getName()
       {
         return $this->name;
       }

       public function buyOne() {
         if ($this->quantity > 0) {
           $this->quantity--;
           return true;
         } else {
           return false;
         }
       }
 }
