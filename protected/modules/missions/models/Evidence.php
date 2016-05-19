<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use yii\db\ActiveRecord;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "evidence".
 *
 * @property integer $id
 * @property string $title
 * @property string $type
 * @property string $main_content
 * @property string $content
 * @property integer $user_id
 * @property integer $activities_id
 * @property integer $space_id
 * @property string $created
 * @property string $modified
 *
 * @property Space $space
 * @property Activities $activities
 * @property User $user
 */ 
class Evidence extends ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable 
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_EDIT = 'edit';
    public $autoAddToWall = true;
    //public $wallEntryClass = 'humhub\modules\polls\widgets\WallEntry';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evidence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            [['title', 'type', 'main_content', 'content', 'user_id', 'activities_id', 'space_id', 'created', 'modified'], 'required'],
            [['main_content', 'content'], 'string'],
            [['user_id', 'activities_id', 'space_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['title'], 'string', 'max' => 120],
            [['type'], 'string', 'max' => 255],
            //[['activities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activities_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        );
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type'),
            'main_content' => Yii::t('app', 'Main Content'),
            'content' => Yii::t('app', 'Content'),
            'user_id' => Yii::t('app', 'User ID'),
            //'activities_id' => Yii::t('app', 'Activities ID'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpace()
    {
        return $this->hasOne(Space::className(), ['id' => 'space_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasOne(Activities::className(), ['id' => 'activities_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('MissionsModule.models_Missions', "Evidence");
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->main_content;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {

        $itemAnswers = "";

        foreach ($this->answers as $answer) {
            $itemAnswers .= $answer->answer;
        }

        return array(
            'question' => $this->question,
            'itemAnswers' => $itemAnswers
        );
    }    

}
