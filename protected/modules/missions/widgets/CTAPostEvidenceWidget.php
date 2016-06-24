<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;
use humhub\modules\space\models\Membership;

class CTAPostEvidenceWidget extends Widget
{

	public $space;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $query = Membership::find()
        // (new \yii\db\Query())
        // ->select(['s.space_id as space_id'])
        // ->from('space_membership as s')
        ->where(['user_id' => Yii::$app->user->getIdentity()->id])
        ->orderBy('space_id DESC')
        // ->andWhere(['!=', 'space_id', 1])
        ->one();
        
        // $user_space_id = $query['space_id'];
        // var_dump(Yii::$app->user->getIdentity()->username);
        // foreach($query as $q): var_dump($q->space->name); var_dump($q['space_id']); endforeach;
        
        return $this->render('cta_post_evidence', array('member' => $query));
    }

}

?>