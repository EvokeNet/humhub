<?php

namespace humhub\modules\missions;

use Yii;
use humhub\models\Setting;
use yii\helpers\Url;

use humhub\modules\missions\models\Missions;
use humhub\modules\missions\models\MissionTranslations;
use humhub\modules\missions\models\Activities;
use humhub\modules\missions\models\ActivityTranslations;

class Module extends \humhub\components\Module
{
    
    /**
    * @inheritdoc
    */
    public function getConfigUrl()
    {
        return Url::to(['/missions/config']);
    }

    /**
    * @inheritdoc
    */
    public function enable()
    {
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

        parent::disable();
    }
    
}

?>