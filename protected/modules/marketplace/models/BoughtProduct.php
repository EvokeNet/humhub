<?php

namespace app\modules\marketplace\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;
use app\modules\marketplace\models\Product;

/**
 * This is the model class for table `wallet`
 *
 * @property integer  $id
 * @property integer  $user_id
 * @property integer  $product_id

 */
 class BoughtProduct extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'bought_products';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         [['user_id', 'product_id'], 'required'],
         [['user_id', 'product_id'], 'integer'],
         [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
         [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'id' => Yii::t('MarketplaceModule.base', 'ID'),
          'user_id' => Yii::t('MarketplaceModule.base', 'User ID'),
          'product_id' => Yii::t('MarketplaceModule.base', 'Product ID'),
        ];
      }

      public function getUser() {
        return User::find()->where(['id' => $this->user_id])->one();
      }

      public function getUserName() {
        return User::find()->where(['id' => $this->user_id])->one()->getName();
      }

      public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
      }

      public function getProductName() {
        return Product::find()->where(['id' => $this->product_id])->one()->name;
      }

      public function isFulfilled() {
        return Product::find()->where(['id' => $this->product_id])->one()->fulfilled;
      }

      public function fulfill() {
        if ($this->fulfilled) {
          return;
        } else {
          $this->fulfilled = true;
          $this->save();
          return;
        }
      }

      public function returnProduct() {
        if ($this->fulfilled) {
          return false;
        } else {
          // add back quantity to product
          $product = $this->product;
          $product->quantity++;
          $product->save();
          $this->delete();
          return true;
        }
      }
 }
