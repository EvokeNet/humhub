<?php

namespace humhub\modules\static_pages;

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
    // public static function onAboutTopMenuInit($event)
    // {
    //     if(Yii::$app->user->getIdentity()->super_admin == 1){

    //         $event->sender->addItem(array(
    //         'label' => Yii::t('StaticPagesModule.base', 'About'),
    //         'id' => 'static_pages_about',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/static_pages/static-pages/about'),
    //         'sortOrder' => 1000,
    //         'isActive' => (
    //             Yii::$app->controller->module && Yii::$app->controller->module->id == 'static_pages' 
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
        if(Yii::$app->user->getIdentity()->super_admin == 1){

            $event->sender->addItem(array(
            'label' => Yii::t('StaticPagesModule.base', 'How To Play'),
            'id' => 'static_pages_how_to',
            'icon' => '<i class="fa fa-th"></i>',
            'url' => Url::toRoute('/static_pages/static-pages/how-to'),
            'sortOrder' => 1000,
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'static_pages' 
                && Yii::$app->controller->id != 'admin'
                && Yii::$app->controller->action->id == 'how-to'
                // &&(
                //     Yii::$app->controller->action->id != 'about'
                //     || Yii::$app->controller->action->id != 'privacy-policy'
                //     || Yii::$app->controller->action->id != 'terms-conditions'
                // )
             ),
            ));
        }
        
    }
    
    // public static function onPrivacyPolicyTopMenuInit($event)
    // {
    //     if(Yii::$app->user->getIdentity()->super_admin == 1){

    //         $event->sender->addItem(array(
    //         'label' => Yii::t('StaticPagesModule.base', 'Privacy Policy'),
    //         'id' => 'static_pages_privacy-policy',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/static_pages/static-pages/privacy-policy'),
    //         'sortOrder' => 1000,
    //         'isActive' => (
    //             Yii::$app->controller->module && Yii::$app->controller->module->id == 'static_pages' 
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
    //         'label' => Yii::t('StaticPagesModule.base', 'Terms & Conditions'),
    //         'id' => 'static_pages_terms_conditions',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/static_pages/static-pages/terms-conditions'),
    //         'sortOrder' => 1000,
    //         'isActive' => (
    //             Yii::$app->controller->module && Yii::$app->controller->module->id == 'static_pages' 
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
