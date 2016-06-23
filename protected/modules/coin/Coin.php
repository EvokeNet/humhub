<?php

namespace app\modules\coin;

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

     // anything else that needs to be inited here
   }
 }
