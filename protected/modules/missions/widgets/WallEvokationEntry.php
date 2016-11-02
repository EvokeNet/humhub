<?php

namespace humhub\modules\missions\widgets;

use Yii;
use app\modules\missions\models\EvokationDeadline;


class WallEvokationEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute = "/missions/evokation/edit";
    
    public function run()
    {
        $deadline = EvokationDeadline::getVotingDeadline();

        $total_investment =  (new \yii\db\Query())
                    ->select(["SUM(p.investment) as total_investment"])
                    ->from('portfolio p')
                    ->where('p.evokation_id = '.$this->contentObject->id)
                    ->one()['total_investment'];
        $total_investment = $total_investment ? $total_investment : 0;    

        $total_investors =  (new \yii\db\Query())
                    ->select(["COUNT(p.id) as total_investors"])
                    ->from('portfolio p')
                    ->where('p.evokation_id = '.$this->contentObject->id)
                    ->one()['total_investors'];

        $total_investors = $total_investors ? $total_investors : 0;   

        if($total_investors % 2 == 0){
            $median = $total_investors / 2;
        }else{
            $median = floor($total_investors/2)+1;
        }
                       
        $median_investment =  (new \yii\db\Query())
                    ->select(["p.investment as median_investment"])
                    ->from('portfolio p')
                    ->where('p.evokation_id = '.$this->contentObject->id)
                    ->orderBy('p.investment')
                    ->limit(1)
                    ->offset($median - 1)
                    ->one()['median_investment'];

        $median_investment = $median_investment ? $median_investment : 0;   
        
        return $this->render('entry_evokation', array(
            'evokation' => $this->contentObject,
            'user' => $this->contentObject->content->user,
            'deadline' => $deadline,
            'contentContainer' => $this->contentObject->content->container,
            'total_investment' => $total_investment,
            'median_investment' => $median_investment,
            'total_investors' => $total_investors,
            )
        );
    }

}