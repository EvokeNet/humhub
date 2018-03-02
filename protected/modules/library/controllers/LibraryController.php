<?php

namespace humhub\modules\library\controllers;

use Yii;
use yii\web\Controller;
use app\modules\library\models\LibraryResource;

/**
 * AdminController
 *
 */
class LibraryController extends Controller
{
  public function actionIndex(){
    $library_resources = LibraryResource::find()->orderBy('name ASC')->all();

    return $this->render('index', ['library_resources' => $library_resources]);
  }
}

?>
