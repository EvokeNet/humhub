<?php

namespace humhub\modules\missions\widgets;

use yii;
use \yii\base\Widget;
use app\modules\coin\models\Wallet;
use humhub\models\Setting;
use app\modules\missions\models\Portfolio;

class PortfolioWidget extends \yii\base\Widget
{

	public $portfolio;

    /**
     * @inheritdoc
     */
    public function run()
    {
    	$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);
    	$totalAmount = Portfolio::getTotalInvestment(Yii::$app->user->getIdentity()->id);

    	$investment_limit = intval(Setting::Get('investment_limit'));
    	
    	if($investment_limit > 0){
			$remainingAmount = min($wallet->amount, $investment_limit - $totalAmount);
    	}else{
    		$remainingAmount = $wallet->amount;
    	}

        return $this->render('portfolio', [
        	'portfolio' => $this->portfolio, 
        	'wallet' => $wallet,
        	'remainingAmount' => $remainingAmount,
        	'totalAmount' => $totalAmount
        	]
        );
    }

}

?>