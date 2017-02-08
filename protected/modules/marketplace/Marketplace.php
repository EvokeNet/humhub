<?php

namespace app\modules\marketplace;

use app\modules\marketplace\models\marketplace
/**
 * Marketplace Module Definition Class
 */
 class Marketplace extends \yii\base\Module
 {

   /**
    * @inheritdoc
    */
   public $controllerNamespace = 'app\modules\marketplace\controllers';

   public function init()
   {
     parent::init();
   }
 }
