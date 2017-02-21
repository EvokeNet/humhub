<?php

namespace app\modules\languages\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $id
 * @property string $language
 * @property string $code
 * @property string $created_at
 * @property string $updated_at
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language', 'code', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['language', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language' => Yii::t('app', 'Language'),
            'code' => Yii::t('app', 'Code'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public static function getLanguage(){
        return Languages::findOne(['code' => Yii::$app->language]);
    }
}
