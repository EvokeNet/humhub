<?php

namespace app\modules\prize;

use app\modules\prize\models\prize
/**
 * Prize Module Definition Class
 */
 class Prize extends \yii\base\Module
 {

   /**
    * @inheritdoc
    */
   public $controllerNamespace = 'app\modules\prize\controllers';

   public function init()
   {
     parent::init();
   }
 }
