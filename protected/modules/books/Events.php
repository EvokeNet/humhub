<?php

namespace humhub\modules\books;

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
    public static function onTopMenuInit($event)
    {

        // Is Module enabled on this workspace?
        $event->sender->addItem(array(
            'label' => Yii::t('BooksModule.base', 'Books'),
            //'label' => 'Matching Questions',
            'id' => 'books',
            'icon' => '<i class="fa fa-th"></i>',
            'url' => Url::toRoute('/books/books'),
            'sortOrder' => 100,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'books'),
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
