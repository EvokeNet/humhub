<?php

namespace humhub\modules\missions\widgets;

class WallCreateForm extends \humhub\modules\content\widgets\WallCreateContentForm
{

    /**
     * @inheritdoc
     */
    public $submitUrl = '/missions/evidence/create';
    public $activity;

    /**
     * @inheritdoc
     */
    public function renderForm()
    {
        return $this->render('form', array('activity' => $this->activity));
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->contentContainer instanceof \humhub\modules\space\models\Space) {
            
            if (!$this->contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvidence())) {
                return;
            }
        }

        return parent::run();
    }

}

?>