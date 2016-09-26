<?php


namespace humhub\modules\teams\controllers;


class TeamController extends \humhub\modules\content\components\ContentContainerController
{

    /**
     * Follows a Space
     */
    public function actionFollow()
    {
        $this->forcePostRequest();
        $space = $this->getSpace();
        if (!$space->isMember()) {
            $space->follow();
        }
    }

    /**
     * Unfollows a Space
     */
    public function actionUnfollow()
    {
        $this->forcePostRequest();
        $space = $this->getSpace();
        $space->unfollow();
    }

}

?>
