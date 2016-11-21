<?php

namespace humhub\modules\missions\widgets;

use yii;
use \yii\base\Widget;
use app\modules\coin\models\Wallet;
use humhub\models\Setting;
use app\modules\missions\models\Portfolio;
use yii\helpers\Url;
use app\modules\teams\models\Team;
use humhub\modules\space\models\Space;
use app\modules\missions\models\EvokationDeadline;

class PortfolioWidget extends \yii\base\Widget
{

	public $portfolio;

    /**
     * @inheritdoc
     */
    public function run()
    {
    
    	$team_id = Team::getUserTeam(Yii::$app->user->getIdentity()->id);
    	$team = Team::findOne($team_id);

    	if(!$team){
    		$team = Space::findOne(['name' => 'Mentors']);
    	}

    	$evokations_url = Url::to(['/missions/evokations/voting', 'sguid' => $team->guid]);	
    	
    	$wallet = Wallet::findOne(['owner_id' => Yii::$app->user->getIdentity()->id]);
    	$totalAmount = Portfolio::getTotalInvestment(Yii::$app->user->getIdentity()->id);

    	$investment_limit = intval(Setting::Get('investment_limit'));

    	if($investment_limit > 0){
			$remainingAmount = min($wallet->amount, $investment_limit - $totalAmount);
    	}else{
    		$remainingAmount = $wallet->amount;
    	}

        $deadline = EvokationDeadline::getVotingDeadline();

        return $this->render('portfolio', [
        	'portfolio' => $this->portfolio, 
        	'wallet' => $wallet,
        	'remainingAmount' => $remainingAmount,
        	'totalAmount' => $totalAmount,
        	'evokations_url' => $evokations_url,
            'deadline' => $deadline
        	]
        );

    }

}

?>