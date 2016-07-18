<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;
use humhub\modules\space\models\Membership;
use app\modules\teams\models\Team;

class CTAPostEvidence extends Widget
{

	public $space;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $team_id = Team::getUserTeam(Yii::$app->user->getIdentity()->id);
        $query = Membership::findOne(['space_id' => $team_id]);
        
        return $this->render('cta_post_evidence', array('member' => $query));
    }

}

?>