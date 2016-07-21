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
use humhub\modules\user\models\User;
use app\modules\novel\models\NovelPage;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{

    public static function onAuthUser($event){

        //on login and create account actions
        if($event->action->actionMethod === 'actionLogin' || $event->action->actionMethod === 'actionCreateAccount'){
          //make sure user is logged in
          if (null != Yii::$app->user->getIdentity())
          {
            //Check if user hasn't read the graphic novel yet or if they are a mentor
            if(Yii::$app->user->getIdentity()->has_read_novel == false && Yii::$app->user->getIdentity()->group->name != "Mentors"){
                $event->action->controller->redirect(Url::toRoute(['/novel/novel/graphic-novel', 'page' => 1]));
            }
          }
        }

    }

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('NovelModule.base', 'Graphic Novel'),
            'url' => Url::to(['/novel/admin']),
            'group' => 'manage',
            'sortOrder' => 1400,
            'icon' => '<i class="fa fa-book"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'novel'
            ),
        ));
    }

}
