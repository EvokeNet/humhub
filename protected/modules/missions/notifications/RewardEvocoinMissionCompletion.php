<?php


namespace humhub\modules\missions\notifications;

use humhub\modules\user\models\User;

class RewardEvocoinMissionCompletion extends \humhub\modules\notification\components\BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'missions';

    /**
     * @inheritdoc
     */
    public $viewName = 'rewardEvocoin_mission_completion';

    /**
     * @inheritdoc
     */
    public function send(User $user)
    {
        
        if($this->source){
            // Check if there is also a mention notification, so skip this notification
            if (\humhub\modules\notification\models\Notification::find()->where(['class' => \humhub\modules\user\notifications\Mentioned::className(), 'user_id' => $user->id, 'source_class' => $this->source->className(), 'source_pk' => $this->source->getPrimaryKey()])->count() > 0) {
                return;
            }    
        }
        

        return parent::send($user);
    }

    public function render(){

        if($this->source == null){
            $this->delete();
            return;
        }else{
            return parent::render();
        }

    }


}

?>
