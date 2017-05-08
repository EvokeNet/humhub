<?php

namespace app\modules\novel\models;
use app\modules\novel\models\Chapter;
use app\modules\novel\models\NovelPage;

use Yii;

/**
 * This is the model class for table "chapter_pages".
 *
 * @property integer $chapter_id
 * @property integer $novel_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Novel $novel
 * @property Chapter $chapter
 */
class ChapterPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chapter_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chapter_id', 'novel_id'], 'required'],
            [['chapter_id', 'novel_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['novel_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovelPage::className(), 'targetAttribute' => ['novel_id' => 'id']],
            [['chapter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chapter::className(), 'targetAttribute' => ['chapter_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'chapter_id' => 'Chapter ID',
            'novel_id' => 'Page ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNovel()
    {
        return $this->hasOne(NovelPage::className(), ['id' => 'novel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChapter()
    {
        return $this->hasOne(Chapter::className(), ['id' => 'chapter_id']);
    }
}
