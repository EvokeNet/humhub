<?php

namespace app\modules\prize;

use app\modules\prize\models\prize
/**
 * Coin Module Definition Class
 */
 class Coin extends \yii\base\Module
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
