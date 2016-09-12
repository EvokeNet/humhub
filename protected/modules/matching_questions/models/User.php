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
            'id' => Yii::t('MatchingModule.base', 'ID'),
            'guid' => Yii::t('MatchingModule.base', 'Guid'),
            'wall_id' => Yii::t('MatchingModule.base', 'Wall ID'),
            'group_id' => Yii::t('MatchingModule.base', 'Group ID'),
            'status' => Yii::t('MatchingModule.base', 'Status'),
            'super_admin' => Yii::t('MatchingModule.base', 'Super Admin'),
            'username' => Yii::t('MatchingModule.base', 'Username'),
            'email' => Yii::t('MatchingModule.base', 'Email'),
            'auth_mode' => Yii::t('MatchingModule.base', 'Auth Mode'),
            'tags' => Yii::t('MatchingModule.base', 'Tags'),
            'language' => Yii::t('MatchingModule.base', 'Language'),
            'last_activity_email' => Yii::t('MatchingModule.base', 'Last Activity Email'),
            'created_at' => Yii::t('MatchingModule.base', 'Created At'),
            'created_by' => Yii::t('MatchingModule.base', 'Created By'),
            'updated_at' => Yii::t('MatchingModule.base', 'Updated At'),
            'updated_by' => Yii::t('MatchingModule.base', 'Updated By'),
            'last_login' => Yii::t('MatchingModule.base', 'Last Login'),
            'visibility' => Yii::t('MatchingModule.base', 'Visibility'),
            'time_zone' => Yii::t('MatchingModule.base', 'Time Zone'),
            'contentcontainer_id' => Yii::t('MatchingModule.base', 'Contentcontainer ID'),
            'superhero_identity_id' => Yii::t('MatchingModule.base', 'Superhero Identity ID'),
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

    /**
     *
     * @return type
     */
    public function getSpaces()
    {

        // TODO: SHOW ONLY REAL MEMBERSHIPS
        return $this->hasMany
        (\humhub\modules\space\models\Space::className(), ['id' => 'space_id'])
            ->viaTable('space_membership', ['user_id' => 'id'])
            ->innerJoin('space_membership as m', '`m`.`space_id` = `space`.`id`')
            ->where('m.status = 3')
            ->andWhere('m.user_id ='. $this->id);
    }


}
