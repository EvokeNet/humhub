<?php

namespace app\modules\coin;

use app\modules\coin\models\coin
/**
 * Coin Module Definition Class
 */
 class Coin extends \yii\base\Module
 {

   /**
    * @inheritdoc
    */
   public $controllerNamespace = 'app\modules\coin\controllers';

   public function init()
   {
     parent::init();
   }
 }
