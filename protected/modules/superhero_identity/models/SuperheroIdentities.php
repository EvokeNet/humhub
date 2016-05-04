<?php

namespace app\modules\superhero_identity\models;

use Yii;

/**
 * This is the model class for table "superhero_identities".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $quality_1
 * @property integer $quality_2
 * @property integer $primary_power
 * @property integer $secondary_power
 * @property string $created
 * @property string $modified
 */
class SuperheroIdentities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'superhero_identities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'quality_1', 'quality_2', 'primary_power', 'secondary_power', 'created', 'modified'], 'required'],
            [['quality_1', 'quality_2', 'primary_power', 'secondary_power'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'quality_1' => Yii::t('app', 'Quality 1'),
            'quality_2' => Yii::t('app', 'Quality 2'),
            'primary_power' => Yii::t('app', 'Primary Power'),
            'secondary_power' => Yii::t('app', 'Secondary Power'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
}
