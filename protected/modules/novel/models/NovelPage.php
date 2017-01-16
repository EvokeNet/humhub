<?php

namespace app\modules\novel\models;
use app\modules\languages\models\Languages;
use app\modules\novel\models\Chapter;

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
         [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
         [['chapter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chapter::className(), 'targetAttribute' => ['chapter_id' => 'id']],
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
          'chapter_id' => Yii::t('NovelModule.base', 'Chapter ID'),
        ];
      }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(Chapter::className(), ['id' => 'chapter_id']);
    }

 }
