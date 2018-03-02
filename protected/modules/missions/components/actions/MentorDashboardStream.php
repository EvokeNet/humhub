<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\missions\components\actions;

use Yii;
use humhub\modules\missions\components\actions\FixedStream;

/**
 * DashboardStreamAction
 * Note: This stream action is also used for activity e-mail content.
 *
 * @since 0.11
 * @author luke
 */
class MentorDashboardStream extends DashboardStream
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->activeQuery->leftJoin('user author', 'author.id = wall_entry.created_by');
        $this->activeQuery->andWhere('author.group_id = 2');
        
    }

}
