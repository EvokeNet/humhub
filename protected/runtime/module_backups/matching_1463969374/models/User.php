<?php

namespace app\modules\matching_questions\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $guid
 * @property integer $wall_id
 * @property integer $group_id
 * @property integer $status
 * @property integer $super_admin
 * @property string $username
 * @property string $email
 * @property string $auth_mode
 * @property string $tags
 * @property string $language
 * @property string $last_activity_email
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $last_login
 * @property integer $visibility
 * @property string $time_zone
 * @property integer $contentcontainer_id
 * @property integer $superhero_identity_id
 *
 * @property SuperheroIdentities $superheroIdentity
 * @property UserMatchingAnswers[] $userMatchingAnswers
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wall_id', 'group_id', 'status', 'super_admin', 'created_by', 'updated_by', 'visibility', 'contentcontainer_id', 'superhero_identity_id'], 'integer'],
            [['auth_mode', 'last_activity_email'], 'required'],
            [['tags'], 'string'],
            [['last_activity_email', 'created_at', 'updated_at', 'last_login'], 'safe'],
            [['guid'], 'string', 'max' => 45],
            [['username'], 'string', 'max' => 25],
            [['email', 'time_zone'], 'string', 'max' => 100],
            [['auth_mode'], 'string', 'max' => 10],
            [['language'], 'string', 'max' => 5],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['guid'], 'unique'],
            [['wall_id'], 'unique'],
            [['superhero_identity_id'], 'exist', 'skipOnError' => true, 'targetClass' => SuperheroIdentities::className(), 'targetAttribute' => ['superhero_identity_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'guid' => Yii::t('app', 'Guid'),
            'wall_id' => Yii::t('app', 'Wall ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'status' => Yii::t('app', 'Status'),
            'super_admin' => Yii::t('app', 'Super Admin'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'auth_mode' => Yii::t('app', 'Auth Mode'),
            'tags' => Yii::t('app', 'Tags'),
            'language' => Yii::t('app', 'Language'),
            'last_activity_email' => Yii::t('app', 'Last Activity Email'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'last_login' => Yii::t('app', 'Last Login'),
            'visibility' => Yii::t('app', 'Visibility'),
            'time_zone' => Yii::t('app', 'Time Zone'),
            'contentcontainer_id' => Yii::t('app', 'Contentcontainer ID'),
            'superhero_identity_id' => Yii::t('app', 'Superhero Identity ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuperheroIdentity()
    {
        return $this->hasOne(SuperheroIdentities::className(), ['id' => 'superhero_identity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserMatchingAnswers()
    {
        return $this->hasMany(UserMatchingAnswers::className(), ['user_id' => 'id']);
    }
}
