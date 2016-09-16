<?php

namespace app\modules\stats\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "stats_general".
 *
 * @property integer $id
 * @property integer $total_users
 * @property integer $total_agents
 * @property integer $total_mentors
 * @property integer $total_evidences
 * @property double $avg_evidence_player
 * @property integer $total_posts
 * @property integer $total_spaces
 * @property integer $total_teams
 * @property integer $total_images
 * @property integer $total_videos
 * @property double $avg_evidence_words
 * @property integer $total_comments
 * @property integer $total_comments_mentors
 * @property integer $total_comments_players
 * @property double $comments_by_user
 * @property integer $total_reviews
 * @property double $avg_review_by_agents
 * @property double $avg_review_by_mentors
 * @property double $avg_review_received
 * @property double $avg_review_per_evidence
 * @property integer $total_review_comments
 * @property integer $total_review_comments_agents
 * @property integer $total_review_comments_mentors
 * @property integer $total_review_likes
 * @property integer $total_review_likes_agents
 * @property integer $total_review_likes_mentors
 * @property integer $total_evocoins
 * @property integer $total_evocoins_agents
 * @property integer $total_evocoins_mentors
 * @property double $avg_evocoins_users
 * @property double $avg_evocoins_agents
 * @property double $avg_evocoins_mentors
 * @property string $created_at
 * @property string $updated_at
 */
class StatsGeneral extends \yii\db\ActiveRecord
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
        return 'stats_general';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_users', 'total_agents', 'total_mentors', 'total_evidences', 'total_posts', 'total_spaces', 'total_teams', 'total_images', 'total_videos', 'total_comments', 'total_comments_mentors', 'total_comments_players', 'total_reviews', 'total_review_comments', 'total_review_comments_agents', 'total_review_comments_mentors', 'total_review_likes', 'total_review_likes_agents', 'total_review_likes_mentors', 'total_evocoins', 'total_evocoins_agents', 'total_evocoins_mentors'], 'integer'],
            [['avg_evidence_player', 'avg_evidence_words', 'comments_by_user', 'avg_review_by_agents', 'avg_review_by_mentors', 'avg_review_received', 'avg_review_per_evidence', 'avg_evocoins_users', 'avg_evocoins_agents', 'avg_evocoins_mentors'], 'number'],
            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'total_users' => Yii::t('app', 'Total Users'),
            'total_agents' => Yii::t('app', 'Total Agents'),
            'total_mentors' => Yii::t('app', 'Total Mentors'),
            'total_evidences' => Yii::t('app', 'Total Evidences'),
            'avg_evidence_player' => Yii::t('app', 'Avg Evidence Player'),
            'total_posts' => Yii::t('app', 'Total Posts'),
            'total_spaces' => Yii::t('app', 'Total Spaces'),
            'total_teams' => Yii::t('app', 'Total Teams'),
            'total_images' => Yii::t('app', 'Total Images'),
            'total_videos' => Yii::t('app', 'Total Videos'),
            'avg_evidence_words' => Yii::t('app', 'Avg Evidence Words'),
            'total_comments' => Yii::t('app', 'Total Comments'),
            'total_comments_mentors' => Yii::t('app', 'Total Comments Mentors'),
            'total_comments_players' => Yii::t('app', 'Total Comments Players'),
            'comments_by_user' => Yii::t('app', 'Comments By User'),
            'total_reviews' => Yii::t('app', 'Total Reviews'),
            'avg_review_by_agents' => Yii::t('app', 'Avg Review By Agents'),
            'avg_review_by_mentors' => Yii::t('app', 'Avg Review By Mentors'),
            'avg_review_received' => Yii::t('app', 'Avg Review Received'),
            'avg_review_per_evidence' => Yii::t('app', 'Avg Review Per Evidence'),
            'total_review_comments' => Yii::t('app', 'Total Review Comments'),
            'total_review_comments_agents' => Yii::t('app', 'Total Review Comments Agents'),
            'total_review_comments_mentors' => Yii::t('app', 'Total Review Comments Mentors'),
            'total_review_likes' => Yii::t('app', 'Total Review Likes'),
            'total_review_likes_agents' => Yii::t('app', 'Total Review Likes Agents'),
            'total_review_likes_mentors' => Yii::t('app', 'Total Review Likes Mentors'),
            'total_evocoins' => Yii::t('app', 'Total Evocoins'),
            'total_evocoins_agents' => Yii::t('app', 'Total Evocoins Agents'),
            'total_evocoins_mentors' => Yii::t('app', 'Total Evocoins Mentors'),
            'avg_evocoins_users' => Yii::t('app', 'Avg Evocoins Users'),
            'avg_evocoins_agents' => Yii::t('app', 'Avg Evocoins Agents'),
            'avg_evocoins_mentors' => Yii::t('app', 'Avg Evocoins Mentors'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
