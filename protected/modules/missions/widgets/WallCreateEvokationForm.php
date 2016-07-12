<?php

namespace humhub\modules\missions\widgets;

class WallCreateEvokationForm extends \humhub\modules\content\widgets\WallCreateContentForm
{

    /**
     * @inheritdoc
     */
    public $submitUrl = '/missions/evokations/create';
    public $mission;

    /**
     * @inheritdoc
     */
    public function renderForm()
    {
        return $this->render('form_evokation', array('mission' => $this->mission));
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if ($this->contentContainer instanceof \humhub\modules\space\models\Space) {
            
            if (!$this->contentContainer->permissionManager->can(new \humhub\modules\missions\permissions\CreateEvokation())) {
                return;
            }
        }

        return parent::run();
    }

}

?>