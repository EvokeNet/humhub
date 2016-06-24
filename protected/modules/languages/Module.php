<?php

namespace humhub\modules\languages;

use Yii;
use humhub\models\Setting;
use yii\helpers\Url;

use app\modules\languages\models\Languages;

class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/languages/config']);
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
        foreach (Languages::find()->all() as $item) {
            $item->delete();
        }

        parent::disable();
    }
    
}

?>
