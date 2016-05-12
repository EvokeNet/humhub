<?php

namespace humhub\modules\matching_questions;

use Yii;
use yii\helpers\Url;
// use humhub\modules\matching_questions\models\MatchingQuestions;

/**
 * Description of Events
 *
 */
class Events
{

    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event)
    {

        // Is Module enabled on this workspace?
        $event->sender->addItem(array(
            // 'label' => Yii::t('MatchingQuestionsModule.base', 'Matching Questions'),
            'label' => 'Matching Questions',
            'id' => 'matching_questions',
            'icon' => '<i class="fa fa-th"></i>',
            'url' => Url::toRoute('/matching_questions/matching-questions/matching'),
            'sortOrder' => 100,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'matching_questions'),
        ));
    }

    public static function onSidebarInit($event)
    {
        if (Setting::Get('enable', 'share') == 1) {
            if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
                $event->sender->addWidget(ShareWidget::className(), array(), array('sortOrder' => 150));
            }
        }
    }

}
