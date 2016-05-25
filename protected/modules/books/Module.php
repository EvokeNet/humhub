<?php

namespace humhub\modules\books;

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
        return Url::to(['/books/config']);
    }

    /**
     * @inheritdoc
     */
    public function enable()
    {
        parent::enable();
    }

}

?>
