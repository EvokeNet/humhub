<?php

namespace app\modules\novel;

/**
 * Novel Module Definition Class
 */
 class Novel extends \yii\base\Module
 {

   /**
    * @inheritdoc
    */
   public $controllerNamespace = 'app\modules\novel\controllers';

   public function init()
   {
     parent::init();
   }
 }
