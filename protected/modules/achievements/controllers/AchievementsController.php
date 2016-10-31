<?php

namespace humhub\modules\achievements\controllers;

use Yii;

use yii\web\Controller;
use app\modules\achievements\models\Achievements;
use app\modules\achievements\models\UserAchievements;
use humhub\modules\user\models\User;

/**
 * Achievements controller for the `achievements` module
 */

class AchievementsController extends Controller
{
    public function actionIndex($id = NULL)
    {
        $user = Yii::$app->user->getIdentity();

        if($id != NULL){
            $user = User::findOne(['id' => $id]);
        }

        $achievements = Achievements::find()->all();

        $user_achievements = UserAchievements::find()->where(['user_id' => $user->id])->all();

        return $this->render('index', array('user' => $user, 'user_achievements' => $user_achievements, 'achievements' => $achievements));

    }

}
