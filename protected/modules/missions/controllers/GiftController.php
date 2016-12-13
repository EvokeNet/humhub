<?php

namespace humhub\modules\missions\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use humhub\modules\missions\controllers\AlertController;
use app\modules\coin\models\Wallet;

class GiftController extends Controller
{
	public function actionEvocoins(){
		$user = Yii::$app->user->getIdentity();
        $wallet = Wallet::findOne(['owner_id' => $user->id]);
        $value = Yii::$app->request->post('Gift')['evocoins'];
		if($wallet->amount >= $value){
			AlertController::createAlert("Success!", Yii::t('MissionsModule.base', 'You gave it away some of your evocoins.'));
		}else{
			AlertController::createAlert("Error", Yii::t('MissionsModule.base', 'No enough Evocoins!'));
		}
		
	}

}