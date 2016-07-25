<?php

namespace humhub\modules\static_pages;

use Yii;
use humhub\models\Setting;
use yii\helpers\Url;

class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/static_pages/config']); 
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
    // public function disable()
    // {
    //     foreach (Languages::find()->all() as $item) {
    //         $item->delete();
    //     }

    //     parent::disable();
    // }
    
}

?>
