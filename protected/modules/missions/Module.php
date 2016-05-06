<?php

    namespace humhub\modules\missions;

    use Yii;
    use humhub\models\Setting;
    use yii\helpers\Url;

    /**
    * BirthdayModule is responsible for the the birthday functions.
    * 
    * @author Sebastian Stumpf
    */
    class Module extends \humhub\components\Module
    {
        
        public function init()
        {
            parent::init();

            // custom initialization code goes here
        }
        
        /**
        * @inheritdoc
        */
        // public function getConfigUrl()
        // {
        //     return Url::to(['/missions/config']);
        // }

        /**
        * @inheritdoc
        */
        // public function enable()
        // {
        //     parent::enable();
        //     Setting::Set('shownDays', 2, 'birthday');
        // }

    }

?>
