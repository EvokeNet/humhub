<?php

namespace humhub\modules\superhero_identity\controllers;

use Yii;
use humhub\models\Setting;
use humhub\modules\superhero_identity\models\MatchingQuestion;

/**
 * Defines the configure actions.
 *
 * @package humhub.modules.supero_identity.controllers
 * @author Sebastian Stumpf
 */
class MatchingController extends \humhub\modules\admin\components\Controller
{

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex()
    {
    	//List all matching questions
        $model = MatchingQuestion::findAll();


        return $this->render('index');
    }

}

?>
