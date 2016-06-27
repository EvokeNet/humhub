<?php

namespace app\modules\coin\controllers;

use Yii;
use app\modules\coins\models\Coins;
use yii\rest\ActiveController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Coin Controller implements the CRUD actions for Coin model.
 */
class WalletController extends ActiveController
{

  public $modelClass = 'app\modules\coins\models\Wallet';

  /**
   * @inheritdoc
   */
  public function actions()
  {
    $actions = parent::actions();

    return $actions;
  }
}
