<?php

namespace app\modules\powers\models;

use Yii;
use app\modules\powers\models\QualityPowers;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\UserQualities;
use app\modules\powers\models\PowerTranslations;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "powers".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property double $improve_multiplier
 * @property double $improve_offset
 *
 * @property ActivityPowers[] $activityPowers
 * @property PowerTranslations[] $powerTranslations
 * @property QualityPowers[] $qualityPowers
 * @property RubricVotes[] $rubricVotes
 * @property UserPowers[] $userPowers
 */
class Powers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'powers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'improve_multiplier', 'improve_offset'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['improve_multiplier', 'improve_offset'], 'number'],
            [['title'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('PowersModule.base', 'ID'),
            'title' => Yii::t('PowersModule.base', 'Title'),
            'description' => Yii::t('PowersModule.base', 'Description'),
            'created_at' => Yii::t('PowersModule.base', 'Created At'),
            'updated_at' => Yii::t('PowersModule.base', 'Updated At'),
            'improve_multiplier' => Yii::t('PowersModule.base', 'Improve Multiplier'),
            'improve_offset' => Yii::t('PowersModule.base', 'Improve Offset'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivityPowers()
    {
        return $this->hasMany(ActivityPowers::className(), ['power_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPowerTranslations()
    {
        return $this->hasMany(PowerTranslations::className(), ['power_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQualityPowers()
    {
        return $this->hasMany(QualityPowers::className(), ['power_id' => 'id']);
    }

    public function getQualityPowersArray()
    {
        $powers = QualityPowers::find()->where(['power_id' => $this->id])->all();
        return $powers;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubricVotes()
    {
        return $this->hasMany(RubricVotes::className(), ['power_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPowers()
    {
        return $this->hasMany(UserPowers::className(), ['power_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $user_powers = UserPowers::findAll(['power_id' => $this->id]);
        $quality = QualityPowers::findOne(['power_id' => $this->id]);

        if($quality && $quality->quality_id){

            //update power and quality levels
            foreach($user_powers as $user_power){
                $user_power->updateLevel();
                $user_quality = UserQualities::findOne(['quality_id' => $quality->quality_id]);
                $user_quality->updateLevel();
            }
        }
        return parent::afterSave($insert, $changedAttributes);

    }

    /**
     *  returns the name of the power in the appropriate language
     *  @return string
     */
    public function getName()
    {
      $lang = Languages::findOne(['code' => Yii::$app->language]);
      if(isset($lang)){
          $power_name = PowerTranslations::findOne(['power_id' => $this->id, 'language_id' => $lang->id]);
          if(isset($power_name))
              return $power_name->title;
          else
            return $this->title;
      } else{
        return $this->title;
      }
    }

    public function getDescription()
    {
      $lang = Languages::findOne(['code' => Yii::$app->language]);
      if(isset($lang))
          return $power_description = PowerTranslations::findOne(['power_id' => $this->id])->description;
      else{
        return $this->description;
      }
    }

}
