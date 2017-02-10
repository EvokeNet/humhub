<?php

namespace app\modules\alliances\models;

use Yii;

/**
 * This is the model class for table `library_resources`
 *
 * @property integer $id
 * @property string  $string
 */
 class Alliance extends \yii\db\ActiveRecord
 {
   /**
    * @inheritdoc
    */
    public static function tablename()
    {
      return 'alliances';
    }

    /**
     * @inheritdoc
     */
     public function rules()
     {
       return [
         ['team_1', 'required'],
         ['team_1', 'unique', 'targetAttribute' => 'team_2'],
         ['team_2', 'required'],
         ['team_2', 'unique', 'targetAttribute' => 'team_1']
       ];
     }

     /**
      * @inheritdoc
      */
      public function attributeLabels()
      {
        return [
          'team_1' => Yii::t('AlliancesModule.base', 'Team 1'),
          'team_2' => Yii::t('AlliancesModule.base', 'Team 2'),
        ];
      }

      /**
       *  Gets the ally for a given team
       * @return string
       */
       public function getAlly($team_id)
       {
         return 'no ally';
       }
 }
