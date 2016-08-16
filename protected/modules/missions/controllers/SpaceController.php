<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\missions\controllers;

use Yii;
use humhub\modules\space\modules\manage\components\Controller;


class SpaceController extends Controller
{

    public function actionMembers()
    {
        $memberQuery = $this->space->getMemberships();
        $memberQuery->joinWith('user');
        $memberQuery->where(['user.status' => \humhub\modules\user\models\User::STATUS_ENABLED]);

        return $this->render('members', ['members' => $memberQuery->all()]);
    }

}

?>
