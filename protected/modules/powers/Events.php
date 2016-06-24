<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\powers;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use humhub\modules\powers\widgets\UserPowersWidget;
use app\modules\powers\models\UserPowers;

/**
 * Description of Events
 *
 */
class Events extends \yii\base\Object
{
    public static function onAdminMenuInit($event)
    {
        $event->sender->addItem(array(
            'label' => Yii::t('PowersModule.base', 'Powers'),
            'url' => Url::to(['/powers/admin']),
            'group' => 'manage',
            'icon' => '<i class="fa fa-bolt"></i>',
            'isActive' => (
                Yii::$app->controller->module && Yii::$app->controller->module->id == 'powers'
            ),
        ));
    }

    public static function onProfileSidebarInit($event)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->getIdentity()->getSetting("hideSharePanel", "share") != 1) {
            
            //$powers = UserPowers::findAll(['user_id' => $user = $event->sender->user->id]);
            $powers = UserPowers::find()
            ->where(['user_id' => $user = $event->sender->user->id])
            ->joinWith('qualityPowers', true, 'INNER JOIN')
            ->orderBy('quality_powers.quality_id')
            ->all();

            $quality_id = -1;
            $qualities = array();
            $quality_powers = array();

            foreach($powers as $power){                

                if($power->getPower()->getQualityPowers()[0]->quality_id != $quality_id){
                    $quality_id = $power->getPower()->getQualityPowers()[0]->quality_id;

                    if(!empty($quality_powers)){
                        array_push($qualities, $quality_powers);
                    }
    
                    $quality_powers = array();
                }

                array_push($quality_powers, $power);
            }

            if(!empty($quality_powers)){
                array_push($qualities, $quality_powers);
            }

            foreach($qualities as $quality_powers){
                $event->sender->addWidget(UserPowersWidget::className(), array('powers' => $quality_powers), array('sortOrder' => 9));
            }
            
        }
        
    }

}
