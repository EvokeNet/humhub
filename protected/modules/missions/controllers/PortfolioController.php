<?php

namespace humhub\modules\missions\controllers;

use Yii;
use app\modules\missions\models\Portfolio;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\Evokations;
use app\modules\missions\models\EvokationDeadline;
use humhub\models\Setting;

class PortfolioController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    private function checkVotingClosed(){
        $deadline = EvokationDeadline::getVotingDeadline();

        //if voting is closed
        if ($deadline && $deadline->hasEnded()){
            header('Content-type: application/json');
            $response_array['status'] = 'error'; 
            echo json_encode($response_array);
            Yii::$app->end();
        }
    }

    public function actionAdd($evokation_id, $investment){

        $this->checkVotingClosed();

        $user = Yii::$app->user->getIdentity();
        $wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);
        $totalAmount = Portfolio::getTotalInvestment(Yii::$app->user->getIdentity()->id);

        $this->checkCanInvestWallet($investment, $wallet);
        $this->checkCanInvestLimit($investment, $totalAmount);


         if(intval($investment)){
            if($investment >= 0){

                $evokation = Evokations::findOne($evokation_id);

                // can't add own evokation
                if($evokation && $evokation->content->user_id != Yii::$app->user->getIdentity()->id){

                    $evokation_investment = new Portfolio();
                    $evokation_investment->user_id = $user->id;
                    $evokation_investment->evokation_id = $evokation_id;
                    $evokation_investment->investment = $investment;
                    $evokation_investment->save();

                    //update wallet
                    $wallet->amount =  $wallet->amount - ($evokation_investment->investment);
                    $wallet->save();

                    header('Content-type: application/json');
                    $response_array['status'] = 'success'; 
                    echo json_encode($response_array);
                    Yii::$app->end();
                }
            }
        }

        header('Content-type: application/json');
        $response_array['status'] = 'error'; 
        echo json_encode($response_array);
        Yii::$app->end();
    }

    private function checkCanInvestLimit($investment, $totalInvestment){
        $investment_limit = intval(Setting::Get('investment_limit'));
        
         if($investment_limit > 0 && ($investment + $totalInvestment > Setting::Get('investment_limit'))){
            header('Content-type: application/json');
            $response_array['status'] = 'error_limit'; 
            echo json_encode($response_array);
            Yii::$app->end();
        }
    }

    private function checkCanInvestWallet($investment, $wallet){
        if($investment > $wallet){
            $response_array['status'] = 'no_enough_evocoins'; 
            echo json_encode($response_array);
            Yii::$app->end();
        }
    }

    public function actionDelete($evokation_id){
        $this->checkVotingClosed();

        $user = Yii::$app->user->getIdentity();
        $wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);
        $totalAmount = Portfolio::getTotalInvestment(Yii::$app->user->getIdentity()->id);
        $evokation_investment = Portfolio::findOne(['user_id' => $user->id, 'evokation_id' => $evokation_id]);

        if($evokation_investment){
            //update wallet
            $wallet->amount =  $wallet->amount + ($evokation_investment->investment);
            $wallet->save();

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

    private function isDataValid($portfolio, $totalInvestment){
        //check if data is valid
        foreach($portfolio as $investment){

            if(intval($investment) || $investment == 0){
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
        return $totalInvestment;
    }

    private function isInvestmentPossible($totalInvestment, $wallet, $totalAmount){
        // check if investment is possible
        if($totalInvestment > ($wallet->amount + $totalAmount)){
            $response_array['status'] = 'no_enough_evocoins'; 
            echo json_encode($response_array);
            Yii::$app->end();
        }
    }

    public function actionUpdate(){
        $this->checkVotingClosed();

    	$user = Yii::$app->user->getIdentity();
    	$portfolio = Yii::$app->request->post();
        $totalInvestment = 0;

        $wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);
        $totalAmount = Portfolio::getTotalInvestment(Yii::$app->user->getIdentity()->id);

        $totalInvestment = $this->isDataValid($portfolio, $totalInvestment);

        $this->isInvestmentPossible($totalInvestment, $wallet, $totalAmount);

        $this->checkCanInvestLimit($totalInvestment, 0);

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

        //update wallet
        $wallet->amount =  $wallet->amount + ($totalAmount - $totalInvestment);
        $wallet->save();

    	header('Content-type: application/json');
    	$response_array['status'] = 'success'; 
        echo json_encode($response_array);
        Yii::$app->end();
    }

    public function actionGet($evokation_id, $investment){

        $deadline = EvokationDeadline::getVotingDeadline();
        $user = Yii::$app->user->getIdentity();
        $evokation_investment = new Portfolio();
        $evokation_investment->user_id = $user->id;
        $evokation_investment->evokation_id = $evokation_id;
        $evokation_investment->investment = $investment;

        header('Content-type: application/json');
        $response_array['status'] = 'success'; 
        $response_array['html'] = $this->renderPartial('../../widgets/views/invested_evokation', ['deadline' => $deadline, 'evokation_investment' => $evokation_investment]); 
        echo json_encode($response_array);
        Yii::$app->end();
    }

}
