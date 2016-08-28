<?php

namespace app\modules\missions\models;

use Yii;
use humhub\modules\content\components\ContentActiveRecord;
use yii\db\ActiveRecord;
use app\modules\languages\models\Languages;
use app\modules\space\models\Space;
use humhub\modules\user\models\User;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\modules\missions\models\Portfolio;
use app\modules\coin\models\Wallet;

/**
 * This is the model class for table "evokations".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $youtube_url
 * @property string $gdrive_url
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @property Missions $mission
 */
class Evokations extends ContentActiveRecord implements \humhub\modules\search\interfaces\Searchable
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_EDIT = 'edit';
    const SCENARIO_CLOSE = 'close';
    public $autoAddToWall = true;
    public $wallEntryClass = 'humhub\modules\missions\widgets\WallEvokationEntry';
    
    public function scenarios()
    {
        return [
            self::SCENARIO_CLOSE => [],
            self::SCENARIO_CREATE => ['title', 'description', 'youtube_url', 'gdrive_url'],
            self::SCENARIO_EDIT => ['title', 'description', 'youtube_url', 'gdrive_url']
        ];
    }
    
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
        return 'evokations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'youtube_url', 'gdrive_url'], 'required'],
            [['description', 'youtube_url', 'gdrive_url'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('MissionsModule.model', 'ID'),
            'title' => Yii::t('MissionsModule.model', 'Title'),
            'description' => Yii::t('MissionsModule.model', 'Description'),
            'youtube_url' => Yii::t('MissionsModule.model', 'Youtube Url'),
            'gdrive_url' => Yii::t('MissionsModule.model', 'Gdrive Url'),
            'created_at' => Yii::t('MissionsModule.model', 'Created At'),
            'created_by' => Yii::t('MissionsModule.model', 'Created By'),
            'updated_at' => Yii::t('MissionsModule.model', 'Updated At'),
            'updated_by' => Yii::t('MissionsModule.model', 'Updated By'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('MissionsModule.models_Missions', "Evokation");
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return $this->title;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
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
        * Get YouTube code from YouTube link
        * @param string link
        * @return string YouTube code
        */
    public function getYouTubeCode($link)
    {
            $pos = explode('v=', $link);
            if($pos != false && count($pos) > 1) 
                return $pos['1'];
            else
                return null;
    }


    public function beforeDelete()
    {
        $evokation_investments = Portfolio::findAll(['evokation_id' => $this->id]);

        foreach($evokation_investments as $evokation_investment){
            
            if($evokation_investment->investment > 0){
                $wallet = Wallet::findOne(['owner_id' => $evokation_investment->user_id]);
                $wallet->amount = $wallet->amount + ($evokation_investment->investment);
                $wallet->save();
            }

            $evokation_investment->delete();
            
        }

        return parent::beforeDelete();
    }    

    public function hasUserSubmittedEvokation($userId = "")
    {

        if ($userId == "")
            $userId = Yii::$app->user->id;

        $evokation = Evokations::findOne(['created_by' => $userId]);

        if($evokation){
            return true;
        }

        return false;
    }

}
