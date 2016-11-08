<?php


namespace humhub\modules\achievements\notifications;

use Yii;
use humhub\modules\user\models\User;
use yii\helpers\Url;


class NewAchievement extends \humhub\modules\notification\components\BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = 'achievements';

    /**
     * @inheritdoc
     */
    public $viewName = 'newAchievement';

    /**
     * @inheritdoc
     */
    public function send(User $user)
    {
        // Check if there is also a mention notification, so skip this notification
		if (\humhub\modules\notification\models\Notification::find()->where(['class' => \humhub\modules\user\notifications\Mentioned::className(), 'user_id' => $user->id, 'source_class' => $this->source->className(), 'source_pk' => $this->source->getPrimaryKey()])->count() > 0) {
            return;
        }

        return parent::send($user);
    }

    public function render(){

        if($this->source == null){
            $this->delete();
            return;
        }else{
            return $this->customRender();
        }

    }

    public function customRender($mode = self::OUTPUT_WEB, $params = [])
    {
        $params['originator'] = $this->originator;
        $params['source'] = $this->source;
        $params['space'] = $this->space;
        $params['record'] = $this->record;
        $params['isNew'] = ($this->record->seen != 1);
        $params['url'] = Url::to(['/achievements/achievements/index']);

        $viewFile = $this->getViewPath() . '/' . $this->viewName . '.php';

        // Switch to extra mail view file - if exists (otherwise use web view)
        if ($mode == self::OUTPUT_MAIL || $mode == self::OUTPUT_MAIL_PLAINTEXT) {
            $viewMailFile = $this->getViewPath() . '/mail/' . ($mode == self::OUTPUT_MAIL_PLAINTEXT ? 'plaintext/' : '') . $this->viewName . '.php';
            if (file_exists($viewMailFile)) {
                $viewFile = $viewMailFile;
            }
        } elseif ($mode == self::OUTPUT_TEXT) {
            $html = Yii::$app->getView()->renderFile($viewFile, $params, $this);
            return strip_tags($html);
        }

        $params['content'] = Yii::$app->getView()->renderFile($viewFile, $params, $this);

        return Yii::$app->getView()->renderFile(($mode == self::OUTPUT_WEB) ? $this->layoutWeb : ($mode == self::OUTPUT_MAIL_PLAINTEXT ? $this->layoutMailPlaintext : $this->layoutMail), $params, $this);
    }
    
}

?>
