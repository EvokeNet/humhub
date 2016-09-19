<?php

namespace humhub\modules\missions\components;

use Yii;
use humhub\modules\content\models\Content;
use humhub\modules\content\components\actions\Stream;
use humhub\modules\missions\components\actions\FixedStream;

class MentorContentContainerStream extends FixedStream
{

    public $contentContainer;

    public function init()
    {
        parent::init();

        /**
         * Limit to public posts when no member
         */
        if (!$this->contentContainer->canAccessPrivateContent($this->user)) {
            if(!Yii::$app->user->isGuest) {
                $this->activeQuery->andWhere("content.visibility=" . Content::VISIBILITY_PUBLIC . " OR content.created_by = :userId", [':userId' => $this->user->id]);
            } else {
                $this->activeQuery->andWhere("content.visibility=" . Content::VISIBILITY_PUBLIC);
            }
        }

        /**
         * Handle sticked posts only in content containers
         */
        if ($this->limit != 1) {
            if ($this->from == '') {
                $oldOrder = $this->activeQuery->orderBy;
                $this->activeQuery->orderBy("");

                $this->activeQuery->addOrderBy('content.sticked DESC');
                $this->activeQuery->addOrderBy($oldOrder);
            } else {
                $this->activeQuery->andWhere("(content.sticked != 1 OR content.sticked is NULL)");
            }
        }
    }

}