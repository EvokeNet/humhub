<?php

namespace app\modules\powers\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;
use app\modules\powers\models\QualityPowers;
use app\modules\powers\models\Powers;

/**
 * This is the model class for table "user_powers".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $power_id
 * @property integer $value
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Powers $power
 * @property User $user
 */
class UserPowers extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_powers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'power_id', 'value', 'level'], 'required'],
            [['user_id', 'power_id', 'value', 'level'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['power_id'], 'exist', 'skipOnError' => true, 'targetClass' => Powers::className(), 'targetAttribute' => ['power_id' => 'id']],
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
            'power_id' => Yii::t('PowersModule.base', 'Power ID'),
            'value' => Yii::t('PowersModule.base', 'Value'),
            'level' => Yii::t('PowersModule.base', 'Level'),
            'created_at' => Yii::t('PowersModule.base', 'Created At'),
            'updated_at' => Yii::t('PowersModule.base', 'Modified At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPower()
    {
        $power = Powers::findOne($this->power_id);
        return $power;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPowers()
    {
        return $this->hasOne(Powers::className(), ['id' => 'power_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQualityPowers()
    {
        return $this->hasMany(QualityPowers::className(), ['power_id' => 'power_id']);
    }

    public function getUserQuality()
    {
        $quality_power = QualityPowers::findOne(['power_id' => $this->power_id]);
        return UserQualities::findOne(['user_id' => $this->user_id, 'quality_id' => $quality_power->quality_id]);
    }

    public function getLevel(){
        if(!$this->level){
            $this->updateLevel();
        }
        return $this->level;
    }

    public function getNextLevelPoints(){

        $level = $this->getLevel() + 1;

        if($level >= 1){
            $power = Powers::findOne($this->power_id);
            $improve_multiplier = $power->improve_multiplier;
            $improve_offset = $power->improve_offset;

            if(!$improve_multiplier || !$improve_offset){
                return 1;
            }

            return floor(floatval($improve_multiplier) * pow( $level , 1.95 ) + floatval($improve_offset));
        }else{
            return 1;
        }
    }

    public function getCurrentLevelPoints(){

        $level = $this->getLevel();

        if($level >= 1){
            $power = Powers::findOne($this->power_id);
            $improve_multiplier = $power->improve_multiplier;
            $improve_offset = $power->improve_offset;

            if(!$improve_multiplier || !$improve_offset){
                return 0;
            }

            return $this->value - floor(floatval($improve_multiplier) * pow( $level , 1.95 ) + floatval($improve_offset));
        }else{
            return $this->value;
        }
    }

    public function updateLevel(){
        $power = Powers::findOne($this->power_id);
        $improve_multiplier = $power->improve_multiplier;
        $improve_offset = $power->improve_offset;
        $value_aux = 0;
        $level_aux = 0;
        $old_level = $this->level;

        if(!$improve_multiplier || !$improve_offset){
            return;
        }

        while($value_aux < $this->value){
            $level_aux++;
            $value_aux = floor(floatval($improve_multiplier) * pow( $level_aux , 1.95 ) + floatval($improve_offset));            
        } 

        if($value_aux > $this->value){
            $level_aux--;
        }

        $level_aux;

        $this->level = $level_aux;
        $this->save();

        if($this->level != $old_level){

            $quality_power = QualityPowers::findOne(['power_id' => $this->power_id]);
            if($quality_power){
                UserQualities::updateQualityLevel($quality_power->quality_id, $this->user_id);
            }

        }
    }

    public function addPowerPoint($power, $user, $value){
        $userPower = UserPowers::findOne(['power_id' => $power->id, 'user_id' => $user->id]);

        if(isset($userPower)){
            if(!isset($userPower->value)){
                $userPower->value = 0;
            }
            $userPower->value += $value;
        }else{
            $userPower = new UserPowers();
            $userPower->user_id = $user->id;
            $userPower->power_id = $power->id;
            $userPower->value = $value;
        }  

        $userPower->save();
        $userPower->updateLevel();
    }

    public function getUserPowers($user_id){
     $powers = UserPowers::find()
        ->where(['user_id' => $user_id])
        ->joinWith('qualityPowers', false, 'INNER JOIN')
        ->joinWith('powers', false, 'INNER JOIN')
        ->joinWith('qualityPowers.quality', false, "INNER JOIN")
        ->orderBy('qualities.name, powers.title')
        ->all();

        $quality_id = -1;
        $qualities = array();
        $quality_powers = array();

        foreach($powers as $power){                

/*
            echo "<pre>";
            print_r($power->getPower()->getQualityPowers());
            echo "</pre>";
            return array();

*/
            if($power->getPower()->getQualityPowersArray()[0]->quality_id != $quality_id){
                $quality_id = $power->getPower()->getQualityPowersArray()[0]->quality_id;

                if(!empty($quality_powers)){
                    array_push($qualities, $quality_powers);
                }

                $quality_powers = array();
            }

            array_push($quality_powers, $power);
        }

        if(!empty($quality_powers)){
            array_push($qualities, $quality_powers);
        }

        return $qualities;
    }

}
