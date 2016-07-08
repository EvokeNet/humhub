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
        ->where(['created_by' => $this->user->id])
        ->count();
        
        $avg_rating = Evidence::getUserAverageRating($this->user->id);
        
        $wallet = Wallet::findOne(['owner_id' => $this->user->id]);
        
        return $this->render('custom_profile_header', array(
            'user' => $this->user,
            'evidences' => $evidences,
            'isProfileOwner' => $this->isProfileOwner,
            'avg_rating' => $avg_rating,
            'wallet' => $wallet
        ));
    }

}

?>
