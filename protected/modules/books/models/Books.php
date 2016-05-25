<?php

namespace app\modules\books\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property integer $publisher_id
 * @property integer $author_id
 * @property string $title
 * @property string $abstract
 * @property string $created_at
 * @property string $updated_at
 *
 * @property BookTranslations[] $bookTranslations
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publisher_id', 'author_id'], 'required'],
            [['publisher_id', 'author_id'], 'integer'],
            [['abstract'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'publisher_id' => Yii::t('app', 'Publisher ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'title' => Yii::t('app', 'Title'),
            'abstract' => Yii::t('app', 'Abstract'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookTranslations()
    {
        return $this->hasMany(BookTranslations::className(), ['book_id' => 'id']);
    }
}
