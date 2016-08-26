<?php

namespace humhub\modules\stats\controllers;

use Yii;
use app\modules\missions\models\Missions;
use app\modules\missions\models\MissionTranslations;
use app\modules\missions\models\Activities;
use app\modules\missions\models\ActivityTranslations;
use app\modules\missions\models\ActivityPowers;
use app\modules\missions\models\DifficultyLevels;
use app\modules\missions\models\EvokationCategories;
use app\modules\missions\models\EvokationCategoryTranslations;
use app\modules\missions\models\EvokationDeadline;

use app\modules\missions\models\Evidence;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\comment\models\Comment;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\Votes;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{
    public function actionIndex(){
        $evidences = Evidence::find()->count();
        
        $users = User::find()->count();
        
        $agents = User::find()
        ->andWhere(['!=','group_id', '2'])
        ->count();
        
        $mentors = User::find()
        ->where(['group_id' => '2'])
        ->count();
        
        $spaces = Space::find()->all();
        
        $comments = Comment::find()->count();
        
        $comments_agents = Comment::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '1'])
        ->count();
        
        $comments_mentors = Comment::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '2'])
        ->count();
        
        $votes_agents = Votes::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '1'])
        ->count();
        
        $votes_mentors = Votes::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '2'])
        ->count();
        
        $coin=Wallet::find()
        ->sum('amount');
        
        $coins_agents = Wallet::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '1'])
        ->sum('amount');
        
        $coins_mentors = Wallet::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '2'])
        ->sum('amount');
                
        return $this->render('index', array(
            'evidences' => $evidences,
            'users' => $users,
            'agents' => $agents,
            'mentors' => $mentors,
            'spaces' => $spaces,
            'comments' => $comments,
            'coins_agents' => $coins_agents,
            'coins_mentors' => $coins_mentors,
            'votes_agents' => $votes_agents,
            'votes_mentors' => $votes_mentors,
            'comments_agents' => $comments_agents,
            'comments_mentors' => $comments_mentors,
        ));
    }
    
    public function actionUserStats(){
        
        $users = User::find()
        ->joinWith(['evidence u'], true, 'INNER JOIN')
        // ->where(['u.id' => '1'])
        ->one();
        
        $teams = User::find()
        // ->joinWith(['evidence u'], true, 'INNER JOIN')
        // ->where(['is_team' => '1'])
        // ->with(
        //     [
        //         'evidence' => function ($query) {
        //             $query->andWhere(['' => $lang->id]);
        //         },
        //     ]
        // )
        ->all();
        
        var_dump($users);
        
        return $this->render('user-stats', array(
        ));
    }
    
    public function actionSpaceStats(){
        
        $teams = Space::find()
        ->joinWith(['evidence u'], true, 'INNER JOIN')
        ->where(['is_team' => '1'])
        ->one();
        
        $teams = Space::find()
        // ->joinWith(['evidence u'], true, 'INNER JOIN')
        ->where(['is_team' => '1'])
        ->with(
            [
                'spaceMembership' => function ($query) {
                    $query->andWhere(['language_id' => $lang->id]);
                },
            ]
        )
        ->all();
        
        var_dump($teams);
        
        return $this->render('space-stats', array(
        ));
    }
}