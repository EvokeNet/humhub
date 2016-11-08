<?php

namespace humhub\modules\statics;

use Yii;
use yii\helpers\Url;
// use humhub\modules\matching_questions\models\MatchingQuestions;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{
    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    // public statics function onAboutTopMenuInit($event)
    // {
    //     if(Yii::$app->user->getIdentity()->super_admin == 1){

    //         $event->sender->addItem(array(
    //         'label' => Yii::t('StaticsModule.base', 'About'),
    //         'id' => 'statics_about',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/static/static-pages/about'),
    //         'sortOrder' => 1000,
    //         'isActive' => (
    //             Yii::$app->controller->module && Yii::$app->controller->module->id == 'static'
    //             && Yii::$app->controller->id != 'admin'
    //             && Yii::$app->controller->action->id == 'about'
    //             &&(
    //                 Yii::$app->controller->action->id != 'how_to'
    //                 || Yii::$app->controller->action->id != 'privacy-policy'
    //                 || Yii::$app->controller->action->id != 'terms-conditions'
    //             )
    //          ),
    //         ));
    //     }

    // }

    public static function onHowToTopMenuInit($event)
    {
      // $event->sender->addItem(array(
      // 'label' => Yii::t('StaticsModule.base', 'How To Play'),
      // 'id' => 'statics_how_to',
      // 'icon' => '<i class="fa fa-th"></i>',
      // 'url' => Url::toRoute('/statics/statics/how-to'),
      // 'sortOrder' => 1000,
      // 'isActive' => (
      //     Yii::$app->controller->module && Yii::$app->controller->module->id == 'statics'
      //     && Yii::$app->controller->id != 'admin'
      //     && Yii::$app->controller->action->id == 'how-to'
      //     // &&(
      //     //     Yii::$app->controller->action->id != 'about'
      //     //     || Yii::$app->controller->action->id != 'privacy-policy'
      //     //     || Yii::$app->controller->action->id != 'terms-conditions'
      //     // )
      //  ),
      // ));
    }

    // public static function onPrivacyPolicyTopMenuInit($event)
    // {
    //     if(Yii::$app->user->getIdentity()->super_admin == 1){

    //         $event->sender->addItem(array(
    //         'label' => Yii::t('StaticModule.base', 'Privacy Policy'),
    //         'id' => 'static_privacy-policy',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/static/static-pages/privacy-policy'),
    //         'sortOrder' => 1000,
    //         'isActive' => (
    //             Yii::$app->controller->module && Yii::$app->controller->module->id == 'static'
    //             && Yii::$app->controller->id != 'admin'
    //             && Yii::$app->controller->action->id == 'privacy-policy'
    //             &&(
    //                 Yii::$app->controller->action->id != 'about'
    //                 || Yii::$app->controller->action->id != 'how-to'
    //                 || Yii::$app->controller->action->id != 'terms-conditions'
    //             )
    //          ),
    //         ));
    //     }

    // }

    // public static function onTermsTopMenuInit($event)
    // {
    //     if(Yii::$app->user->getIdentity()->super_admin == 1){

    //         $event->sender->addItem(array(
    //         'label' => Yii::t('StaticModule.base', 'Terms & Conditions'),
    //         'id' => 'static_terms_conditions',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/static/static-pages/terms-conditions'),
    //         'sortOrder' => 1000,
    //         'isActive' => (
    //             Yii::$app->controller->module && Yii::$app->controller->module->id == 'static'
    //             && Yii::$app->controller->id != 'admin'
    //             && Yii::$app->controller->action->id == 'terms-conditions'
    //             &&(
    //                 Yii::$app->controller->action->id != 'about'
    //                 || Yii::$app->controller->action->id != 'how-to'
    //                 || Yii::$app->controller->action->id != 'privacy-policy'
    //             )
    //          ),
    //         ));
    //     }

    // }

}
