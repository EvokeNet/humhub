<?php

namespace humhub\modules\stats\widgets;

use Yii;
use \yii\base\Widget;
use humhub\modules\user\widgets\ProfileHeader;
use app\modules\missions\models\Evidence;
use app\modules\coin\models\Wallet;

class CustomProfileHeader extends ProfileHeader
{
    /**
     * @inheritdoc
     */
    public function run()
    {
        $evidences = Evidence::find()
        ->join('INNER JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `evidence`.`id` = `c`.`object_id`')
        ->where(['evidence.created_by' => $this->user->id])
        ->andWhere(['visibility' => 1])
        ->count();
        
        $avg_rating = Evidence::getUserAverageRating($this->user->id);
        
        $wallet = Wallet::findOne(['owner_id' => $this->user->id]);
        
        return $this->render('customProfileHeader', array(
            'user' => $this->user,
            'evidences' => $evidences,
            'isProfileOwner' => $this->isProfileOwner,
            'avg_rating' => $avg_rating,
            'wallet' => $wallet
        ));
    }

}

?>
