<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\novel;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{

    public static function onAuthUser($event){

        //on login and create account actions
        if($event->action->actionMethod === 'actionLogin' || $event->action->actionMethod === 'actionCreateAccount'){

            //Check if user is logged in and if user hasn't superhero id yet
            if(null != Yii::$app->user->getIdentity() && !isset(Yii::$app->user->getIdentity()->superhero_identity_id)){
                $event->action->controller->redirect(Url::toRoute('/matching_questions/matching-questions/matching'));
            }
        }

    }

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('NovelModule.base', 'Graphic Novel'),
            'url' => Url::to(['/novel/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-book"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'novel'
            ),
        ));
    }

}
