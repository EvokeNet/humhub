<?php

namespace app\modules\books\models;

use Yii;
use app\modules\languages\models\Languages;

/**
 * This is the model class for table "book_translations".
 *
 * @property integer $id
 * @property integer $book_id
 * @property string $title
 * @property string $abstract
 * @property string $language
 * @property integer $language_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Languages $language0
 * @property Books $book
 */
class BookTranslations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_translations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'title'], 'required'],
            [['book_id', 'language_id'], 'integer'],
            [['abstract', 'language'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['language_id'], 'exist', 'skipOnError' => true, 'targetClass' => Languages::className(), 'targetAttribute' => ['language_id' => 'id']],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'book_id' => Yii::t('app', 'Book ID'),
            'title' => Yii::t('app', 'Title'),
            'abstract' => Yii::t('app', 'Abstract'),
            'language' => Yii::t('app', 'Language'),
            'language_id' => Yii::t('app', 'Language ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'book_id']);
    }
}
