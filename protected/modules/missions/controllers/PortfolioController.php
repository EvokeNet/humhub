<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Portfolio;

class PortfolioController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionUpdate(){
    	$user = Yii::$app->user->getIdentity();

    	$portfolio = Yii::$app->request->post();

    	foreach($portfolio as $id => $investment){
    		$evokation_investment = Portfolio::findOne(['user_id' => $user->id, 'evokation_id' => $id]);
    		$evokation_investment->investment = $investment;
    		$evokation_investment->save();
    	}

    	header('Content-type: application/json');
    	$response_array['status'] = 'success'; 
        echo json_encode($response_array);
        Yii::$app->end();
    }

}
