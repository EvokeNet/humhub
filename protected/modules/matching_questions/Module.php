<?php

namespace humhub\modules\matching_questions;

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
        return Url::to(['/matching_questions/config']);
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
