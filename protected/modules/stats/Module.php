<?php

namespace humhub\modules\stats;

use Yii;
use humhub\models\Setting;
use yii\helpers\Url;

// use app\modules\stats\models\stats;

class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/stats/config']);
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
        // foreach (Languages::find()->all() as $item) {
        //     $item->delete();
        // }

        parent::disable();
    }
    
}

?>
