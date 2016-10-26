<?php

namespace app\modules\achievements;

use Yii;

/**
 * achievements module definition class
 */
//class Achievements extends \humhub\components\Module
class Achievements extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\achievements\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

    }
    
}