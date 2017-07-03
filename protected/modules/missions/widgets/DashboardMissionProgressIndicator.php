<?php

namespace humhub\modules\missions\widgets;

use Yii;
use \yii\base\Widget;

class DashboardMissionProgressIndicator extends \yii\base\Widget
{


    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('dashboard_mission_progress_indicator', []);
    }

}

?>