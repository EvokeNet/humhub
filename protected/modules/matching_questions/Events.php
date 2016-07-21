<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\matching_questions;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use app\modules\matching_questions\models\SuperheroIdentities;
use app\modules\matching_questions\models\User;
use humhub\modules\matching_questions\widgets\SuperHeroWidget;
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
    // public static function onTopMenuInit($event)
    // {
    //     if(Yii::$app->user->getIdentity()->super_admin == 1){
    //
    //         $event->sender->addItem(array(
    //         'label' => Yii::t('MatchingModule.base', 'Superhero Identity'),
    //         'id' => 'matching_questions',
    //         'icon' => '<i class="fa fa-th"></i>',
    //         'url' => Url::toRoute('/matching_questions/matching-questions/matching'),
    //         'sortOrder' => 200,
    //         'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'matching_questions' && Yii::$app->controller->id != 'admin'),
    //         ));
    //     }
    //
    // }

    public static function onProfileSidebarInit($event)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {

            $user = $event->sender->user;

            /*
            $superhero_id = SuperheroIdentities::findOne([$user->superhero_identity_id]);
            $event->sender->addWidget(SuperHeroWidget::className(), ['superhero_id' => $superhero_id, 'user' => $user], array('sortOrder' => 8));
            */
        }

    }

    // public static function onAuthUser($event){
    //
    //     //on login and create account actions
    //     if($event->action->actionMethod === 'actionLogin' || $event->action->actionMethod === 'actionCreateAccount'){
    //
    //         //Check if user is logged in and if user hasn't superhero id yet
    //         if(null != Yii::$app->user->getIdentity() && !isset(Yii::$app->user->getIdentity()->superhero_identity_id)){
    //             $event->action->controller->redirect(Url::toRoute('/matching_questions/matching-questions/matching'));
    //         }
    //     }
    //
    // }

    public static function onSidebarInit($event)
    {
        if (Setting::Get('enable', 'share') == 1) {
            if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
                $event->sender->addWidget(ShareWidget::className(), array(), array('sortOrder' => 150));
            }
        }
    }

    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MatchingModule.base', 'Matching Questions'),
            'url' => Url::to(['/matching_questions/admin']),
            'group' => 'manage',
            'sortOrder' => 750,
            'icon' => '<i class="fa fa-question"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'matching_questions'
                && Yii::$app->controller->action->id != 'view'

                && Yii::$app->controller->action->id != 'index-qualities'
                && Yii::$app->controller->action->id != 'create-qualities'
                && Yii::$app->controller->action->id != 'update-qualities'

                && Yii::$app->controller->action->id != 'index-quality-translations'
                && Yii::$app->controller->action->id != 'create-quality-translations'
                && Yii::$app->controller->action->id != 'update-quality-translations'

                && Yii::$app->controller->action->id != 'index-superhero-identities'
                && Yii::$app->controller->action->id != 'create-superhero-identities'
                && Yii::$app->controller->action->id != 'update-superhero-identities'

                && Yii::$app->controller->action->id != 'index-superhero-identity-translations'
                && Yii::$app->controller->action->id != 'create-superhero-identity-translations'
                && Yii::$app->controller->action->id != 'update-superhero-identity-translations'
            ),
        ));
    }

    // public static function onSpaceAdminMenuInit($event)
    // {
    //     $space = $event->sender->space;
    //     if ($space->isModuleEnabled('matching_questions') && $space->isAdmin() && $space->isMember()) {
    //         $event->sender->addItem(array(
    //             'label' => Yii::t('MatchingModule.base', 'Matching Questions'),
    //             'group' => 'admin',
    //             'url' => $space->createUrl('/matching_questions/admin'),
    //             'icon' => '<i class="fa fa-th"></i>',
    //             'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'matching_questions' && Yii::$app->controller->id == 'container' && Yii::$app->controller->action->id != 'view'),
    //         ));
    //     }
    // }

    public static function onQualityAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MatchingModule.base', 'Qualities'),
            'url' => Url::to(['/matching_questions/admin/index-qualities']),
            'group' => 'manage',
            'sortOrder' => 800,
            'icon' => '<i class="fa fa-navicon"></i>',
            'isActive' => (
                    Yii::$app->controller->module && Yii::$app->controller->module->id == 'matching_questions'
                    && Yii::$app->controller->id == 'admin'

                    &&
                    (
                        Yii::$app->controller->action->id == 'index-qualities'
                        || Yii::$app->controller->action->id == 'create-qualities'
                        || Yii::$app->controller->action->id == 'update-qualities'

                        || Yii::$app->controller->action->id == 'index-quality-translations'
                        || Yii::$app->controller->action->id == 'create-quality-translations'
                        || Yii::$app->controller->action->id == 'update-quality-translations'

                    )

                    && (
                        Yii::$app->controller->action->id != 'index-superhero-identities'
                        || Yii::$app->controller->action->id != 'create-superhero-identities'
                        || Yii::$app->controller->action->id != 'update-superhero-identities'

                        || Yii::$app->controller->action->id != 'index-superhero-identity-translations'
                        || Yii::$app->controller->action->id != 'create-superhero-identity-translations'
                        || Yii::$app->controller->action->id != 'update-superhero-identity-translations'
                    )
            ),
        ));
    }

    public static function onSuperheroAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('MatchingModule.base', 'Superhero Identity'),
            'url' => Url::to(['/matching_questions/admin/index-superhero-identities']),
            'group' => 'manage',
            'sortOrder' => 700,
            'icon' => '<i class="fa fa-male"></i>',
            'isActive' => (

                Yii::$app->controller->module && Yii::$app->controller->module->id == 'matching_questions'
                && Yii::$app->controller->id == 'admin'
                // &&
                // (
                //     Yii::$app->controller->action->id != 'index-qualities'
                //     && Yii::$app->controller->action->id != 'create-qualities'
                //     && Yii::$app->controller->action->id != 'update-qualities'

                //     || Yii::$app->controller->action->id == 'index-quality-translations'
                //     || Yii::$app->controller->action->id == 'create-quality-translations'
                //     || Yii::$app->controller->action->id == 'update-quality-translations'

                //     || Yii::$app->controller->action->id == 'index-superhero-identities'
                //     || Yii::$app->controller->action->id == 'create-superhero-identities'
                //     || Yii::$app->controller->action->id == 'update-superhero-identities'

                //     || Yii::$app->controller->action->id == 'index-superhero-identity-translations'
                //     || Yii::$app->controller->action->id == 'create-superhero-identity-translations'
                //     || Yii::$app->controller->action->id == 'update-superhero-identity-translations'

                // )
                &&
                    (
                        Yii::$app->controller->action->id != 'index-qualities'
                        || Yii::$app->controller->action->id != 'create-qualities'
                        || Yii::$app->controller->action->id != 'update-qualities'

                        || Yii::$app->controller->action->id != 'index-quality-translations'
                        || Yii::$app->controller->action->id != 'create-quality-translations'
                        || Yii::$app->controller->action->id != 'update-quality-translations'

                    )

                    && (
                        Yii::$app->controller->action->id == 'index-superhero-identities'
                        || Yii::$app->controller->action->id == 'create-superhero-identities'
                        || Yii::$app->controller->action->id == 'update-superhero-identities'

                        || Yii::$app->controller->action->id == 'index-superhero-identity-translations'
                        || Yii::$app->controller->action->id == 'create-superhero-identity-translations'
                        || Yii::$app->controller->action->id == 'update-superhero-identity-translations'
                    )
            ),
        ));
    }

}
