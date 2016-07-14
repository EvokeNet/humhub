<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Portfolio;
use app\modules\coin\models\Wallet;

class PortfolioController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd($evokation_id, $investment){
        $user = Yii::$app->user->getIdentity();

         if(intval($investment)){
            if($investment >= 0){

                $evokation_investment = new Portfolio();
                $evokation_investment->user_id = $user->id;
                $evokation_investment->evokation_id = $evokation_id;
                $evokation_investment->investment = $investment;
                $evokation_investment->save();

                header('Content-type: application/json');
                $response_array['status'] = 'success'; 
                echo json_encode($response_array);
                Yii::$app->end();
                
            }
        }

        header('Content-type: application/json');
        $response_array['status'] = 'error'; 
        echo json_encode($response_array);
        Yii::$app->end();
    }

    public function actionDelete($evokation_id){
        $user = Yii::$app->user->getIdentity();
        $evokation_investment = Portfolio::findOne(['user_id' => $user->id, 'evokation_id' => $evokation_id]);

        if($evokation_investment){
            $evokation_investment->delete();
            header('Content-type: application/json');
            $response_array['status'] = 'success'; 
        }else{
            header('Content-type: application/json');
            $response_array['status'] = 'error'; 
        }

        echo json_encode($response_array);
        Yii::$app->end();

    }

    public function actionUpdate(){
    	$user = Yii::$app->user->getIdentity();

    	$portfolio = Yii::$app->request->post();
        $totalInvestment = 0;
        $wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);

        //check if data is valid
        foreach($portfolio as $investment){
            if(intval($investment)){
                if($investment >= 0){
                    $totalInvestment += $investment;    
                }else{
                    $response_array['status'] = 'invalid_data'; 
                    echo json_encode($response_array);
                    Yii::$app->end(); 
                }
                
            }else{
                $response_array['status'] = 'invalid_data'; 
                echo json_encode($response_array);
                Yii::$app->end(); 
            }
        }

        // check if investment is possible
        if($totalInvestment > $wallet->amount){
            $response_array['status'] = 'no_enough_evocoins'; 
            echo json_encode($response_array);
            Yii::$app->end();
        }

    	foreach($portfolio as $id => $investment){
    		$evokation_investment = Portfolio::findOne(['user_id' => $user->id, 'evokation_id' => $id]);

            // if exists
            if($evokation_investment){
                $evokation_investment->investment = $investment;
                if($investment == 0){
                    $response_array[$id] = 'delete'; 
                    $evokation_investment->delete();    
                }else{
                    $evokation_investment->save();    
                }
            }
    	}

    	header('Content-type: application/json');
    	$response_array['status'] = 'success'; 
        echo json_encode($response_array);
        Yii::$app->end();
    }

}
