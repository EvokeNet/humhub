<?php

/**
 * HumHub
 * Copyright © 2014 The HumHub Project
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 */

namespace humhub\modules\missions\components\actions;

use Yii;
use humhub\modules\content\models\Content;
use humhub\modules\content\models\Wall;
use humhub\modules\content\models\WallEntry;
use humhub\modules\user\models\User;
use yii\base\Exception;

/**
 * BaseStreamAction
 *
 * @package humhub.modules_core.wall
 * @author luke
 * @since 0.11
 */
class FixedStream extends \yii\base\Action
{

    /**
     * Constants used for sorting
     */
    const SORT_CREATED_AT = 'c';
    const SORT_UPDATED_AT = 'u';

    /**
     * Modes
     */
    const MODE_NORMAL = "normal";
    const MODE_ACTIVITY = "activity";

    /**
     * Maximum wall entries per request
     */
    const MAX_LIMIT = 50;

    /**
     * @var string
     */
    public $mode;

    /**
     * First wall entry id to deliver
     *
     * @var int
     */
    public $from;

    /**
     * Sorting Mode
     *
     * @var int
     */
    public $sort;

    /**
     * Maximum wall entries to return
     * @var int
     */
    public $limit = 4;

    /**
     * Filters
     *
     * @var array
     */
    public $filters = array();

    /**
     * @var \yii\db\ActiveQuery
     */
    public $activeQuery;

    /**
     * Optional stream user
     * if no user is specified, the current logged in user will be used.
     *
     * @var User
     */
    public $user = null;

    public function init()
    {

        $this->activeQuery = WallEntry::find();

        // If no user is set, take current if logged in
        if (!Yii::$app->user->isGuest && $this->user == null) {
            $this->user = Yii::$app->user->getIdentity();
        }


        // Read parameters
        if (!Yii::$app->request->isConsoleRequest) {
            $from = Yii::$app->getRequest()->get('from', 0);
            if ($from != 0) {
                $this->from = (int) $from;
            }
            $sort = Yii::$app->getRequest()->get('sort', '');
            if ($sort != "") {
                $this->sort = $sort;
            }
            $limit = Yii::$app->getRequest()->get('limit', '');
            if ($limit != "" && $limit <= self::MAX_LIMIT) {
                $this->limit = $limit;
            }
            $mode = Yii::$app->getRequest()->get('mode', '');
            if ($mode != "" && ($mode == self::MODE_ACTIVITY || $mode == self::MODE_NORMAL)) {
                $this->mode = $mode;
            }
            foreach (explode(',', Yii::$app->getRequest()->get('filters', "")) as $filter) {
                $this->filters[] = trim($filter);
            }
        }

        $this->setupCriteria();
        $this->setupFilters();
    }

    public function setupCriteria()
    {
        $this->activeQuery->joinWith('content');
        $this->activeQuery->joinWith('content.user');
        $this->activeQuery->joinWith('content.space');

        $this->activeQuery->limit($this->limit);
        $this->activeQuery->andWhere(['user.status' => User::STATUS_ENABLED]);
        $this->activeQuery->one();

        /**
         * Handle Stream Mode (Normal Stream or Activity Stream)
         */
        if ($this->mode == self::MODE_ACTIVITY) {
            $this->activeQuery->andWhere(['content.object_model' => \humhub\modules\activity\models\Activity::className()]);

            // Dont show own activities
            if ($this->user != null) {
                $this->activeQuery->leftJoin('activity', 'content.object_id=activity.id AND content.object_model=:activityModel', ['activityModel' => \humhub\modules\activity\models\Activity::className()]);
                $this->activeQuery->andWhere('content.user_id != :userId', array(':userId' => $this->user->id));
            }
        } else {
            $this->activeQuery->andWhere(['!=', 'content.object_model', \humhub\modules\activity\models\Activity::className()]);
        }

        /**
         * Setup Sorting
         */
        if ($this->sort == self::SORT_UPDATED_AT) {
            $this->activeQuery->orderBy('wall_entry.updated_at DESC');
            if ($this->from != "")
                $this->activeQuery->andWhere("wall_entry.updated_at < (SELECT updated_at FROM wall_entry wd WHERE wd.id=" . $this->from . ")");
        } else {
            $this->activeQuery->orderBy('wall_entry.id DESC');
            if ($this->from != "")
                $this->activeQuery->andWhere("wall_entry.id < " . $this->from);
        }
    }

    /**
     * Setup additional filters
     */
    public function setupFilters()
    {
        if (in_array('entry_files', $this->filters)) {
            $fileSelector = (new \yii\db\Query())
                    ->select(["id"])
                    ->from('file')
                    ->where('file.object_model=content.object_model AND file.object_id=content.object_id')
                    ->limit(1);
            $fileSelectorSql = Yii::$app->db->getQueryBuilder()->build($fileSelector)[0];

            $this->activeQuery->andWhere('(' . $fileSelectorSql . ') IS NOT NULL');
        }

        // Setup Post specific filters
        if (in_array('posts_links', $this->filters)) {
            $this->activeQuery->leftJoin('post', 'content.object_id=post.id AND content.object_model=:postModel', ['postModel' => \humhub\modules\post\models\Post::className()]);
            $this->activeQuery->andWhere("post.url is not null");
        }

        // Only apply archived filter when we should load more than one entry
        if ($this->limit != 1) {
            if (!in_array('entry_archived', $this->filters)) {
                $this->activeQuery->andWhere("(content.archived != 1 OR content.archived IS NULL)");
            }
        }
        // Show only mine items
        if (in_array('entry_mine', $this->filters) && $this->user !== null) {
            $this->activeQuery->andWhere(['content.user_id' => $this->user->id]);
        }
        // Show only items where the current user is involed
        if (in_array('entry_userinvoled', $this->filters) && $this->user !== null) {

            $this->activeQuery->leftJoin('user_follow', 'content.object_model=user_follow.object_model AND content.object_id=user_follow.object_id AND user_follow.user_id = :userId', ['userId' => $this->user->id]);
            $this->activeQuery->andWhere("user_follow.id IS NOT NULL");
        }
        if (in_array('model_posts', $this->filters)) {
            $this->activeQuery->andWhere(["content.object_model" => \humhub\modules\post\models\Post::className()]);
        }
        // Visibility filters
        if (in_array('visibility_private', $this->filters)) {
            $this->activeQuery->andWhere(['content.visibility' => Content::VISIBILITY_PRIVATE]);
        }
        if (in_array('visibility_public', $this->filters)) {
            $this->activeQuery->andWhere(['content.visibility' => Content::VISIBILITY_PUBLIC]);
        }
    }

    public function getWallEntries()
    {
        return $this->activeQuery->all();
    }

    public function run()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $this->init();
        $wallEntries = $this->activeQuery->all();

        $output = "";
        $generatedWallEntryIds = array();
        $lastEntryId = "";
        foreach ($wallEntries as $wallEntry) {

            $underlyingObject = $wallEntry->content->getPolymorphicRelation();

            //delete conflict
            if ($underlyingObject === null) {
                $wallEntry->delete();
                continue;
            }

            $underlyingObject->populateRelation('content', $wallEntry->content);

            $output .= $this->controller->renderAjax('@humhub/modules/content/views/layouts/wallEntry', [
                'entry' => $wallEntry,
                'user' => $underlyingObject->content->user,
                'mode' => $this->mode,
                'object' => $underlyingObject,
                'content' => $underlyingObject->getWallOut()
                    ], true);

            $generatedWallEntryIds[] = $wallEntry->id;
            $lastEntryId = $wallEntry->id;
        }

        return [
            'output' => $output,
            'lastEntryId' => $lastEntryId,
            'counter' => count($wallEntries),
            'entryIds' => $generatedWallEntryIds
        ];
    }

}
