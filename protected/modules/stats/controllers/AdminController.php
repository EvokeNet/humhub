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
use humhub\modules\file\models\File;
use humhub\modules\user\models\User;
use humhub\modules\post\models\Post;
use humhub\modules\comment\models\Comment;
use humhub\modules\like\models\Like;
use app\modules\coin\models\Wallet;
use app\modules\missions\models\Votes;

/**
 * AdminController
 *
 */
class AdminController extends \humhub\modules\admin\components\Controller
{
    public function actionIndex(){
        $evidences = Evidence::find()->all();
        
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
        
        $spaces = Space::find()
        ->count();
        
        $teams = Space::find()
        ->where(['is_team' => '1'])
        ->count();
        
        $posts = Post::find()
        ->count();
        
        $images = File::find()
        ->where('mime_type LIKE :substr', array(':substr' => '%image%'))
        // ->where('mime_type LIKE :substr AND object_model LIKE :evidence', array(':substr' => '%image%', ':evidence' => '%Evidence%'))
        ->count();
        
        $videos = File::find()
        ->where('mime_type LIKE :substr', array(':substr' => '%video%'))
        ->count();
        
        $comments_user = Comment::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '1'])
        ->count();
        
        $comments_mentor = Comment::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '2'])
        ->count();
        
        $likes = Like::find()
        ->count();
        
        $like_comment_user = Like::find()
        ->joinWith(['user u'], true, 'INNER JOIN')
        ->where(['u.group_id' => '2'])
        ->count();
                
        $like_comment_user = (new \yii\db\Query())
        ->select(['l.*'])
        ->from('like as l')
        ->join('INNER JOIN', 'user as u', 'l.created_by = `u`.`id`')
        ->where('l.object_model=\''.str_replace("\\", "\\\\", Comment::classname()).'\' AND u.group_id = 1')
        // ->where('g.name != "Mentors"')
        ->count();
        
        $like_comment_mentor = (new \yii\db\Query())
        ->select(['l.*'])
        ->from('like as l')
        ->join('INNER JOIN', 'user as u', 'l.created_by = `u`.`id`')
        ->where('l.object_model=\''.str_replace("\\", "\\\\", Comment::classname()).'\' AND u.group_id = 2')
        // ->where('g.name != "Mentors"')
        ->count();
        
        // var_dump($like_comment_user);
        
        // var_dump($team_evidences);
        // var_dump($team_evidence);
        // var_dump($commentsx);
        // var_dump($commentsx2);
        // var_dump($commentsx3);
                
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
            'spaces' => $spaces,
            'teams' => $teams,
            'posts' => $posts,
            'images' => $images,
            'videos' => $videos,
            'comments_user' => $comments_user,
            'comments_mentor' => $comments_mentor,
            'likes' => $likes,
            'like_comment_user' => $like_comment_user,
            'like_comment_mentor' => $like_comment_mentor
        ));
    }
    
    public function actionUserStats(){
        
        $users = (new \yii\db\Query())
        ->select([
            'u.*, 
            p.firstname, 
            p.lastname, 
            count(c.id) as evidences, 
            count(v.id) as votes,
            count(f.id) as followers,
            count(fg.id) as following, 
            w.amount as coins'
        ])
        ->from('user as u')
        ->join('LEFT JOIN', 'profile as p', 'u.id = `p`.`user_id`')
        ->join('LEFT JOIN', 'group as g', 'u.group_id = `g`.`id`')
        // ->join('INNER JOIN', 'content as c', 'u.id = `c`.`user_id`')
        ->join('LEFT JOIN', 'content as c', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND u.id = `c`.`user_id`')
        ->join('LEFT JOIN', 'votes as v', 'u.id = `v`.`user_id`')
        ->join('LEFT JOIN', 'user_follow as f', '`f`.`object_model`=\''.str_replace("\\", "\\\\", User::classname()).'\' AND `f`.`object_id` = `u`.`id`')
        ->join('LEFT JOIN', 'user_follow as fg', '`fg`.`object_model`=\''.str_replace("\\", "\\\\", User::classname()).'\' AND `fg`.`user_id` = `u`.`id`')
        ->join('LEFT JOIN', 'coin_wallet as w', 'u.id = `w`.`owner_id`')
        // ->join('INNER JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id` AND u.id = `c`.`user_id`')
        ->groupBy('u.id')
        ->orderBy('evidences desc')
        ->all();
        
        return $this->render('user-stats', array(
            'users' => $users,
        ));
    }
    
    public function actionSpaceStats(){
        
        $spaces = (new \yii\db\Query())
        ->select([
            's.*, 
            count(u.id) as members, 
            count(e.id) as evidences, 
            count(v.id) as reviews
            '])
        ->from('space as s')
        ->join('LEFT JOIN', 'space_membership as m', 's.id = `m`.`space_id`')
        ->join('LEFT JOIN', 'votes as v', 'm.user_id = `v`.`user_id`')
        ->join('LEFT JOIN', 'user as u', 'm.user_id = `u`.`id`')
        ->join('LEFT JOIN', 'content as c', 's.id = `c`.`space_id`')
        ->join('LEFT JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->where('s.is_team = 1')
        ->groupBy('s.id')
        // ->orderBy('reviews desc')
        ->all();
                
        return $this->render('space-stats', array(
            'spaces' => $spaces,
        ));
    }
    
    public function actionActivitiesStats(){
        $evidences = Evidence::find()->all();
        
        $activities = Activities::find()
        ->all();
        
        // $activities = (new \yii\db\Query())
        // ->select(['a.*'])
        // ->from('activities as a')
        // ->join('LEFT JOIN', 'missions as m', 'a.mission_id = `m`.`id`')
        // ->join('LEFT JOIN', 'evidence as e', 'a.id = `e`.`activities_id`')
        // ->orderBy('mission_id asc')
        // ->all();
        
        return $this->render('activities-stats', array(
            'evidences' => $evidences,
            'activities' => $activities,
        ));    
    }
    
}