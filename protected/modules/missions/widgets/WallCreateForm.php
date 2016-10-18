<?php

namespace humhub\modules\missions\widgets;

use Yii;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\user\models\User;
use humhub\modules\space\models\Space;

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
        return $this->render('form', array('activity' => $this->activity, 'contentContainer' => $this->contentContainer));
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

    /**
     * @Override
     */
    public static function create(ContentActiveRecord $record, ContentContainerActiveRecord $contentContainer = null, $draft)
    {
        Yii::$app->response->format = 'json';

        // Get Content Container by Parameter (deprecated!)
        if ($contentContainer === null) {
            $containerClass = Yii::$app->request->post('containerClass');
            $containerGuid = Yii::$app->request->post('containerGuid', "");
            if ($containerClass === User::className()) {
                $contentContainer = User::findOne(['guid' => $containerGuid]);
            } elseif ($containerClass === Space::className()) {
                $contentContainer = Space::findOne(['guid' => $containerGuid]);
            }
        }

        // Set Visibility
        if ($contentContainer instanceof Space) {
            $record->content->visibility = Yii::$app->request->post('visibility');
        } elseif ($contentContainer instanceof User) {
            $record->content->visibility = 1;
        } else {
            throw new \yii\base\Exception("Invalid content container!");
        }

        if($draft){
            $record->content->visibility = 0;
        }

        $record->content->container = $contentContainer;

        // Handle Notify User Features of ContentFormWidget
        // ToDo: Check permissions of user guids
        $userGuids = Yii::$app->request->post('notifyUserInput');
        if ($userGuids != "") {
            foreach (explode(",", $userGuids) as $guid) {
                $user = User::findOne(['guid' => trim($guid)]);
                if ($user) {
                    $record->content->notifyUsersOfNewContent[] = $user;
                }
            }
        }

        // Store List of attached Files to add them after Save
        $record->content->attachFileGuidsAfterSave = Yii::$app->request->post('fileList');
        if ($record->validate() && $record->save()) {
            return array('wallEntryId' => $record->content->getFirstWallEntryId());
        }

        return array('errors' => $record->getErrors());
    }

}

?>