<?php

namespace app\modules\library\models;

use Yii;

/**
 * This is the model class for table `library_resources`
 *
 * @property integer $id
 * @property string  $string
 */
 class LibraryResource extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'library_resources';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         ['name', 'required'],
         ['name', 'string', 'max' => 256],
         ['link', 'required'],
         ['link', 'string'],
         ['description', 'string'],
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
          'link' => Yii::t('LibraryModule.base', 'Link'),
          'description' => Yii::t('MarketplaceModule.base', 'Description'),
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
