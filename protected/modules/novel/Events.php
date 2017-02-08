<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\novel;

use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use app\modules\novel\models\NovelPage;
use humhub\models\Setting;
use app\modules\missions\models\forms\EvokeSettingsForm;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{

    public static function onAuthUser($event){
      $novel_order = Setting::Get('novel_order');

        //on login and create account actions
        if(property_exists($event->action, "actionMethod") && (($event->action->actionMethod) && $event->action->actionMethod === 'actionLogin' || $event->action->actionMethod === 'actionCreateAccount')){
          //make sure user is logged in
          if (null != Yii::$app->user->getIdentity())
          {
            //check if users are obligated to see the novel
            if(Setting::Get('enabled_novel_read_obligation')){
              //Check if user hasn't read the graphic novel yet or if they are a mentor
              if(Yii::$app->user->getIdentity()->has_read_novel == false && Yii::$app->user->getIdentity()->group->name != "Mentors"){

                //check order
                if($novel_order == EvokeSettingsForm::FIRST_NOVEL){
                    $event->action->controller->redirect(Url::toRoute(['/novel/novel/graphic-novel', 'page' => 1]));

                //check if user has superhero id
                }else if(isset(Yii::$app->user->getIdentity()->superhero_identity_id)){
                    $event->action->controller->redirect(Url::toRoute(['/novel/novel/graphic-novel', 'page' => 1]));
                }

              }
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
                && Yii::$app->controller->action->id == 'index'
            ),
        ));

        $event->sender->addItem(array(
            'label' => Yii::t('NovelModule.base', 'Chapter'),
            'url' => Url::to(['/novel/admin/chapter']),
            'group' => 'manage',
            'sortOrder' => 1350,
            'icon' => '<i class="fa fa-book"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'novel'
                && Yii::$app->controller->action->id == 'chapter'
            ),
        ));
    }

    public static function onTopMenuInit($event)
    {
      $event->sender->addItem(array(
          'label' => Yii::t('NovelModule.base', 'Novel'),
          'id' => 'Novel',
          'icon' => '<i class="fa fa-book"></i>',
          'url' => Url::toRoute(['/novel/novel/graphic-novel', 'page' => 1]),
          'sortOrder' => 800,
          'isActive' => (
              Yii::$app->controller->module && Yii::$app->controller->module->id == 'novel'
          ),
      ));
    }

}
