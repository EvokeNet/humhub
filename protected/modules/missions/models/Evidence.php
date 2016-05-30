<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use yii\db\ActiveRecord;
use app\modules\space\models\Space;
use app\modules\user\models\User;

use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

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
    const SCENARIO_CLOSE = 'close';
    public $autoAddToWall = true;
    public $wallEntryClass = 'humhub\modules\missions\widgets\WallEntry';
    
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
        return 'evidence';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CLOSE => [],
            self::SCENARIO_CREATE => ['title', 'text'],
            self::SCENARIO_EDIT => ['title', 'text']
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array(
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 120],
            [['created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['activities_id'], 'exist', 'skipOnError' => true, 'targetClass' => Activities::className(), 'targetAttribute' => ['activities_id' => 'id']],
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
            //'type' => Yii::t('app', 'Type'),
            //'main_content' => Yii::t('app', 'Main Content'),
            'text' => Yii::t('app', 'Text'),
            //'user_id' => Yii::t('app', 'User ID'),
            'activities_id' => Yii::t('app', 'Activities ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        $activity = Activities::findOne($this->activities_id);
        return $activity;
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
        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {

        return array(
            'title' => $this->title
        );
    }    

    public function getId(){
        return $this->id;
    }

    /**
     * After Saving of comments, fire an activity
     *
     * @return type
     */
    public function afterSave($insert, $changedAttributes)
    {
        
        $activity = new  \humhub\modules\missions\activities\NewEvidence();
        $activity->source = $this;
        $activity->originator = Yii::$app->user->getIdentity();
        $activity->create();
        

        // Handle mentioned users
        // Execute before NewCommentNotification to avoid double notification when mentioned.
        \humhub\modules\user\models\Mentioning::parse($this, $this->text);
        
        if ($insert) {
            $notification = new \humhub\modules\missions\notifications\NewEvidence();
            $notification->source = $this;
            $notification->originator = Yii::$app->user->getIdentity();
            $notification->sendBulk($this->content->getPolymorphicRelation()->getFollowers(null, true, true));
        }

        return parent::afterSave($insert, $changedAttributes);

    }    

}
