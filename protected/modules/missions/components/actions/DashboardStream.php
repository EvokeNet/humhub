<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\missions\components\actions;

use Yii;
use humhub\modules\missions\components\actions\FixedStream;
use app\modules\missions\models\Evidence;
use humhub\modules\post\models\Post;

/**
 * DashboardStreamAction
 * Note: This stream action is also used for activity e-mail content.
 *
 * @since 0.11
 * @author luke
 */
class DashboardStream extends FixedStream
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->user == null) {

            /**
             * For guests collect all wall_ids of "guest" public spaces / user profiles.
             * Generally show only public content
             */
            $publicSpacesSql = (new \yii\db\Query())
                    ->select(["si.wall_id"])
                    ->from('space si')
                    ->where('si.visibility=' . \humhub\modules\space\models\Space::VISIBILITY_ALL);
            $union = Yii::$app->db->getQueryBuilder()->build($publicSpacesSql)[0];


            $publicProfilesSql = (new \yii\db\Query())
                    ->select("pi.wall_id")
                    ->from('user pi')
                    ->where('pi.status=1 AND  pi.visibility = ' . \humhub\modules\user\models\User::VISIBILITY_ALL);
            $union .= " UNION " . Yii::$app->db->getQueryBuilder()->build($publicProfilesSql)[0];

            $this->activeQuery->andWhere('wall_entry.wall_id IN (' . $union . ')');
            $this->activeQuery->andWhere(['content.visibility' => \humhub\modules\content\models\Content::VISIBILITY_PUBLIC]);
        } else {

            /**
             * Collect all wall_ids we need to include into dashboard stream
             */
            // User to user follows
            $userFollow = (new \yii\db\Query())
                    ->select(["uf.wall_id"])
                    ->from('user_follow')
                    ->leftJoin('user uf', 'uf.id=user_follow.object_id AND user_follow.object_model=:userClass')
                    ->where('user_follow.user_id=' . $this->user->id . ' AND uf.wall_id IS NOT NULL');
            $union = Yii::$app->db->getQueryBuilder()->build($userFollow)[0];

            // User to space follows
            $spaceFollow = (new \yii\db\Query())
                    ->select("sf.wall_id")
                    ->from('user_follow')
                    ->leftJoin('space sf', 'sf.id=user_follow.object_id AND user_follow.object_model=:spaceClass')
                    ->where('user_follow.user_id=' . $this->user->id . ' AND sf.wall_id IS NOT NULL');
            $union .= " UNION " . Yii::$app->db->getQueryBuilder()->build($spaceFollow)[0];

            // User to space memberships
            $spaceMemberships = (new \yii\db\Query())
                    ->select("sm.wall_id")
                    ->from('space_membership')
                    ->leftJoin('space sm', 'sm.id=space_membership.space_id')
                    ->where('space_membership.user_id=' . $this->user->id . ' AND sm.wall_id IS NOT NULL AND space_membership.show_at_dashboard = 1');
            $union .= " UNION " . Yii::$app->db->getQueryBuilder()->build($spaceMemberships)[0];

            // Glue together also with current users wall
            $wallIdsSql = (new \yii\db\Query())
                    ->select('wall_id')
                    ->from('user uw')
                    ->where('uw.id=' . $this->user->id);
            $union .= " UNION " . Yii::$app->db->getQueryBuilder()->build($wallIdsSql)[0];

            // Manual Union (https://github.com/yiisoft/yii2/issues/7992)
            $this->activeQuery->andWhere('wall_entry.wall_id IN (' . $union . ')', [':spaceClass' => \humhub\modules\space\models\Space::className(), ':userClass' => \humhub\modules\user\models\User::className()]);

            /**
             * Begin visibility checks regarding the content container
             */
            $this->activeQuery->leftJoin('wall', 'wall_entry.wall_id=wall.id');
            $this->activeQuery->leftJoin(
                    'space_membership', 'wall.object_id=space_membership.space_id AND space_membership.user_id=:userId AND space_membership.status=:status', ['userId' => $this->user->id, ':status' => \humhub\modules\space\models\Membership::STATUS_MEMBER]
            );

            // In case of an space entry, we need to join the space membership to verify the user can see private space content
            $condition = ' (content.object_model =:postModel AND wall.object_model=:userModel AND content.visibility=0 AND content.user_id = :userId) OR ';
            $condition .= ' (content.object_model =:postModel AND wall.object_model=:spaceModel AND content.visibility = 0 AND space_membership.status = ' . \humhub\modules\space\models\Membership::STATUS_MEMBER . ') OR ';
            $condition .= ' (content.object_model =:postModel AND content.visibility = 1 OR content.visibility IS NULL) OR';
            $condition .= ' (content.object_model =:evidenceModel AND (content.visibility = 1 OR content.user_id= :userId) ) ';
            $this->activeQuery->andWhere($condition, [':postModel' => Post::className(), ':evidenceModel' => Evidence::className(), ':userId' => $this->user->id, ':spaceModel' => \humhub\modules\space\models\Space::className(), ':userModel' => \humhub\modules\user\models\User::className()]);
        }
    }

}
