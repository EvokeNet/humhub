<?php

namespace humhub\modules\superhero_identity;

use Yii;
use humhub\models\Setting;
use yii\helpers\Url;

/**
 * BirthdayModule is responsible for the the birthday functions.
 * 
 * @author Sebastian Stumpf
 */
class Module extends \humhub\components\Module
{

    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/superhero_identity/config']);
    }

    /**
     * @inheritdoc
     */
    public function enable()
    {
        parent::enable();
        Setting::Set('shownDays', 2, 'birthday');
    }

}

?>
