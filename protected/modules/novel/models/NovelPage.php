<?php

namespace app\modules\novel\models;

use Yii;

/**
 * This is the model class for table `novel`
 *
 * @property integer $id
 * @property string  $string
 */
 class NovelPage extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'novel';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         ['page_image', 'string', 'max' => 256],
         ['page_number', 'integer', 'min' => 1],
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'id' => Yii::t('NovelModule.base', 'ID'),
          'page_image' => Yii::t('NovelModule.base', 'Image'),
          'page_number' => Yii::t('NovelModule.base', 'Page Number'),
        ];
      }
 }
