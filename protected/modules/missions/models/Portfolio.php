<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "portfolio".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $evokation_id
 * @property integer $investment
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Evokations $evokation
 * @property User $user
 */
class Portfolio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'evokation_id', 'investment', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'evokation_id', 'investment'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['evokation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Evokations::className(), 'targetAttribute' => ['evokation_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'evokation_id' => Yii::t('app', 'Evokation ID'),
            'investment' => Yii::t('app', 'Investment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvokation()
    {
        return $this->hasOne(Evokations::className(), ['id' => 'evokation_id']);
    }

    public function getEvokationObject()
    {
        return Evokations::findOne($this->evokation_id);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserPortfolio($user_id)
    {
        $portfolio = Portfolio::find()
        ->where(['user_id' => $user_id])
        ->joinWith('evokation', false, 'INNER JOIN')
        ->orderBy('evokations.id ASC')
        ->all();

        return $portfolio;
    }

    public function getTotalInvestment($user_id)
    {

        $query = (new \yii\db\Query())

        ->select(['IFNULL(sum(investment), 0) as total'])
        ->from('portfolio')
        ->where(['user_id' => $user_id])
        ->one();

        return $query['total'];

    }

}
