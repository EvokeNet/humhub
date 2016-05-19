<?php

    namespace humhub\modules\missions;

    use Yii;
    use humhub\models\Setting;
    use yii\helpers\Url;
    use humhub\modules\content\components\ContentContainerActiveRecord;
    use humhub\modules\content\components\ContentContainerModule;
    use humhub\modules\space\models\Space;

    /**
    * BirthdayModule is responsible for the the birthday functions.
    * 
    * @author Sebastian Stumpf
    */
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
    public function disable()
    {
        //TODO
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
}

?>