<?php

namespace humhub\modules\missions\widgets;

use humhub\modules\space\models\Setting;

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
        $gdrive_url = Setting::get($this->contentContainer->id, "gdrive_url");

        return $this->render('form_evokation', ['gdrive_url' => $gdrive_url]);
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