<?php

namespace humhub\modules\missions;


use Yii;
use humhub\models\Setting;
use yii\helpers\Url;
use humhub\modules\content\components\ContentContainerActiveRecord;
use humhub\modules\content\components\ContentContainerModule;
use humhub\modules\space\models\Space;

use app\modules\missions\models\Missions;
use app\modules\missions\models\MissionTranslations;
use app\modules\missions\models\Activities;
use app\modules\missions\models\ActivityTranslations;

class Module extends ContentContainerModule
{

    /**
     * @inheritdoc
     */
    public function getContentContainerTypes()
    {
        return [
            Space::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function enable()
    {
        $module = \humhub\modules\space\models\Module::find()->where(['module_id' => 'missions', 'space_id' => 0])->one();

        if(isset($module)){

            $module->state = \humhub\modules\space\models\Module::STATE_FORCE_ENABLED;
            $module->save();

        }else{

            $module = new \humhub\modules\space\models\Module();
            $module->space_id = \humhub\modules\space\models\Module::STATE_FORCE_ENABLED;
            $module->module_id = 'missions';
            $module->state = 0;
            $module->save();
        }

        parent::enable();
    }   

    /**
     * @inheritdoc
     */
    public function disable()
    {

         foreach (Missions::find()->all() as $item) {
            $item->delete();
        }

        foreach (MissionTranslations::find()->all() as $item) {
            $item->delete();
        }
        
        foreach (Activities::find()->all() as $item) {
            $item->delete();
        }

        foreach (ActivityTranslations::find()->all() as $item) {
            $item->delete();
        }

        $module = \humhub\modules\space\models\Module::find()->where(['module_id' => 'missions', 'space_id' => 0])->one();

        if(isset($module)){

            $module->state = \humhub\modules\space\models\Module::STATE_DISABLED;
            $module->save();

        }else{

            $module = new \humhub\modules\space\models\Module();
            $module->space_id = \humhub\modules\space\models\Module::STATE_DISABLED;
            $module->module_id = 'missions';
            $module->state = 0;
            $module->save();
        }

        parent::disable();
    }

    /**
     * @inheritdoc
     */
    public function disableContentContainer(ContentContainerActiveRecord $container)
    {
        // TODO
    }

    /**
     * @inheritdoc
     */
    public function getPermissions($contentContainer = null)
    {
        if ($contentContainer instanceof \humhub\modules\space\models\Space) {
            return [
                new permissions\CreateEvidence()
            ];
        }

        return [];

    }
    

        /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/missions/config']);
    }


}

?>