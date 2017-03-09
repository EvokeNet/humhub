<?php

namespace app\modules\alliances;

/**
 * Library Module Definition Class
 */
 class Alliances extends \yii\base\Module
 {

   /**
    * @inheritdoc
    */
   public $controllerNamespace = 'app\modules\alliances\controllers';

   public function init()
   {
     parent::init();
   }

   public static function isEnabled(){
	 return (new \yii\db\Query())
        ->select(['me.module_id'])
        ->from('module_enabled as me')
        ->where(['module_id' => 'alliances'])
        ->one() ? true : false;   	
   }

 }
