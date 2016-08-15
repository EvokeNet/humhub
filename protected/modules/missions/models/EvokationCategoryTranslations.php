<?php

namespace app\modules\missions\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "evokation_category_translations".
 *
 * @property integer $id
 * @property integer $evokation_category_id
 * @property string $title
 * @property string $description
 * @property integer $language_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EvokationCategories $evokationCategory
 */
class EvokationCategoryTranslations extends \yii\db\ActiveRecord
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
        return 'evokation_category_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['evokation_category_id', 'title', 'description', 'language_id'], 'required'],
            [['evokation_category_id', 'language_id'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 256],
            [['evokation_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => EvokationCategories::className(), 'targetAttribute' => ['evokation_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'evokation_category_id' => Yii::t('app', 'Evokation Category ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'language_id' => Yii::t('app', 'Language ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvokationCategory()
    {
        return $this->hasOne(EvokationCategories::className(), ['id' => 'evokation_category_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }
}
