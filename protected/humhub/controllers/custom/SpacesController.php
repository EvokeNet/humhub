<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\controllers;

use Yii;
use humhub\components\Controller;
use humhub\models\Setting;
use humhub\modules\space\modules\manage\controllers\DefaultController as DefaultController;
use yii\web\HttpException;
use yii\base\UserException;

/**
 * SpacesController
 *
 * @author luke
 * @since 0.11
 */
class SpacesController extends DefaultController
{

    /**
     * Translation settings
     */
    public function actionTranslations()
    {
        $space = $this->contentContainer;
        $space->scenario = 'edit';

        if ($space->load(Yii::$app->request->post()) && $space->validate() && $space->save()) {
            Yii::$app->getSession()->setFlash('data-saved', Yii::t('SpaceModule.controllers_AdminController', 'Saved'));
            return $this->redirect($space->createUrl('translations'));
        }
        return $this->render('translations', array('model' => $space));
    }

}
