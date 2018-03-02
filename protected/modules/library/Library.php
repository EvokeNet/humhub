<?php

namespace app\modules\library;

use app\modules\library\models\library
/**
 * Library Module Definition Class
 */
 class Library extends \yii\base\Module
 {

   /**
    * @inheritdoc
    */
   public $controllerNamespace = 'app\modules\library\controllers';

   public function init()
   {
     parent::init();
   }
 }
