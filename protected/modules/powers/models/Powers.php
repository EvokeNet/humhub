<?php

namespace app\modules\powers\models;

use Yii;
use app\modules\powers\models\QualityPowers;
use app\modules\powers\models\UserPowers;
use app\modules\powers\models\UserQualities;

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
 * @property string $image
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
            // [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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
            'improve_offset' => Yii::t('PowersModule.baseapp', 'Improve Offset'),
            'image' => Yii::t('PowersModule.base', 'Image'),
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
    
    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('uploads/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }
    
}
