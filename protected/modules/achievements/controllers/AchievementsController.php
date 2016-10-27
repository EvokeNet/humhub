<?php

namespace humhub\modules\achievements\controllers;

use Yii;
use yii\web\Controller;
use app\modules\achievements\models\Achievements;
use app\modules\achievements\models\UserAchievements;

/**
 * Achievements controller for the `achievements` module
 */

class AchievementsController extends Controller
{
    public function actionIndex()
    {
        $user = Yii::$app->user->getIdentity();

        // $achievements = Achievements::find()->all();

        $achievements = Achievements::find()->with([
            'userAchievements' => function ($query) {
                $query->andWhere(['user_id' => Yii::$app->user->id]);
            }
        ])->all();

        return $this->render('index', array('user' => $user, 'achievements' => $achievements));
    }

}
