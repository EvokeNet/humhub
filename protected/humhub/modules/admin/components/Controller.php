<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\admin\components;

use Yii;
use humhub\components\behaviors\AccessControl;

/**
 * Base controller for administration section
 *
 * @author luke
 */
class Controller extends \humhub\components\Controller
{

    public $subLayout = "@humhub/modules/admin/views/layouts/main";
    
    public function behaviors()
    {
        return [
            'acl' => [
                'class' => AccessControl::className(),
                'adminOnly' => true
            ]
        ];
    }
    
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action))
            return false;

        // $session = Yii::$app->session;
        // !$session->isActive ? $session->open() : $session->close();
        // Yii::$app->language = $session->get('language');
        // $session->close();
        
        // Yii::$app->language = 'es';

        return true ;
    }

}
