<?php

namespace humhub\modules\superhero_identity\controllers;

use Yii;
use humhub\models\Setting;

/**
 * Defines the configure actions.
 *
 * @package humhub.modules.supero_identity.controllers
 * @author Sebastian Stumpf
 */
class ConfigController extends \humhub\modules\admin\components\Controller
{

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex()
    {

        return $this->render('index');
    }

}

?>
