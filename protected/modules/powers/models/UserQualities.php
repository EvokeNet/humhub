<?php

namespace app\modules\powers\models;

use Yii;
use humhub\modules\user\models\User;
use app\modules\matching_questions\models\Qualities;
use humhub\modules\missions\controllers\AlertController;

/**
 * This is the model class for table "user_qualities".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $quality_id
 * @property integer $level
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Qualities $quality
 * @property User $user
 */
class UserQualities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_qualities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'quality_id', 'level'], 'required'],
            [['user_id', 'quality_id', 'level'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['quality_id'], 'exist', 'skipOnError' => true, 'targetClass' => Qualities::className(), 'targetAttribute' => ['quality_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('PowersModule.base', 'ID'),
            'user_id' => Yii::t('PowersModule.base', 'User ID'),
            'quality_id' => Yii::t('PowersModule.base', 'Quality ID'),
            'level' => Yii::t('PowersModule.base', 'Level'),
            'created_at' => Yii::t('PowersModule.base', 'Created At'),
            'updated_at' => Yii::t('PowersModule.base', 'Modified At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuality()
    {
        return $this->hasOne(Qualities::className(), ['id' => 'quality_id']);
    }

    public function getQualityObject()
    {
        return Qualities::findOne($this->quality_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getLevel(){
        if(null == $this->level){

            $quality_powers = QualityPowers::findAll(['quality_id' => $this->quality_id]);

            foreach($quality_powers as $quality_power){
                $user_power = UserPowers::findOne(['power_id' => $quality_power->power_id, 'user_id' => $this->user_id]);
                
                if($user_power)
                    $user_power->updateLevel();
            }

            return $this->updateLevel();
        }

        return $this->level;
    }

     public function updateLevel(){
        return $this->updateQualityLevel($this->quality_id, $this->user_id);
    }

    public function updateQualityLevel($quality_id, $user_id){

        $query = (new \yii\db\Query())
        ->select(['min(IFNULL(level,0)) as level'])
        ->from('user_powers p')
        ->join('INNER JOIN', 'quality_powers q', 'q.power_id = p.power_id')
        ->where(['user_id' => $user_id, 'quality_id' => $quality_id])
        ->one();

        $level = $query['level'] ? $query['level'] : 0;

        $userQuality = UserQualities::findOne(['quality_id' => $quality_id, 'user_id' => $user_id]);

        $new_power = false;

        if(!isset($userQuality)){
            $userQuality = new UserQualities();
            $userQuality->user_id = $user_id;
            $userQuality->quality_id = $quality_id;

            if($level >= 1){
                $new_power = true;
            }

        }else if( ( (isset($userQuality->level) && $userQuality->level < 1) || (!isset($userQuality->level)) ) && $level >= 1)  {
            $new_power = true;
        }
        
        $name = $userQuality->getQualityObject()->name;
            
        if(Yii::$app->language == 'es' && isset($userQuality->getQualityObject()->qualityTranslations[0]))
            $name = $userQuality->getQualityObject()->qualityTranslations[0]->name;
                
        if($new_power){
            AlertController::createAlert(
                Yii::t('PowersModule.base', "Congratulations!"), 
                Yii::t(
                    'PowersModule.base', 'You have earned the {super_power_name} super power!', 
                    array('super_power_name' => $name)
                ),
                'secondary'
            );
        }

        $userQuality->level = $level;
        $userQuality->save();

        return $level;
    }
}
