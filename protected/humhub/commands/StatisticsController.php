<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\commands;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use humhub\models\Setting;

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

use app\modules\stats\models\StatsActivities;
use app\modules\stats\models\StatsGeneral;
use app\modules\stats\models\StatsUsers;
use app\modules\stats\models\StatsSpaces;

/**
 * Cronjobs
 * 
 * @author Luke
 */
class StatisticsController extends Controller
{

    /**
     * @event Event an event that is triggered when the hourly cron is started.
     */
    const EVENT_ON_HOURLY_RUN = "hourly";

    /**
     * @event Event an event that is triggered when the daily cron is started.
     */
    const EVENT_ON_DAILY_RUN = "daily";
    
    /**
     * Executes weekly cron tasks.
     */
    public function actionWeekly()
    {
        $this->stdout("Executing weekly
         tasks:\n\n", Console::FG_YELLOW);

        $this->trigger(self::EVENT_ON_DAILY_RUN);

        $this->saveGeneralStats();
        $this->saveUsersStats();
        $this->saveSpacesStats();
        $this->saveActivitiesStats();

        $this->stdout("\n\nYay, it worked. All cron tasks finished.\n\n", Console::FG_GREEN);
        Setting::Set('cronLastDailyRun', time());

        return self::EXIT_CODE_NORMAL;
    }

    public function saveGeneralStats(){
        
        $model = new StatsGeneral();

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
        
        $num_words = 0;
        $num_evidences = 0;

        foreach($evidences as $key => $evidence){
            $num_words += str_word_count($evidence->text);
            $num_evidences++;
        }
                
        $model->attributes = array(
            'total_users' => $users,
            'total_agents' => $agents,
            'total_mentors' => $mentors,
            
            'total_evidences' => $num_evidences,
            'avg_evidence_player' => number_format((float)($num_evidences/$agents), 2, '.', ''),
            'total_posts' => $posts,
            'total_spaces' => $spaces,
            'total_teams' => $teams,
            'total_images' => $images,
            'total_videos' => $videos,
            'avg_evidence_words' => number_format((float)($num_words/$num_evidences), 2, '.', ''),
            'total_comments' => $comments,
            'total_comments_mentors' => $comments_mentor,
            'total_comments_players' => $comments_user,
            'comments_by_user' => number_format((float)($comments/$users), 2, '.', ''),
            
            'total_reviews' => ($votes_agents+$votes_mentors),
            'avg_review_by_agents' => number_format((float)($votes_agents/$agents), 2, '.', ''),
            'avg_review_by_mentors' => number_format((float)($votes_mentors/$mentors), 2, '.', ''),
            'avg_review_received' => number_format((float)(($votes_agents+$votes_mentors)/$users), 2, '.', ''),
            'avg_review_per_evidence' => number_format((float)(($votes_agents+$votes_mentors)/$num_evidences), 2, '.', ''),
            'total_review_comments' => $comments_agents+$comments_mentors,
            'total_review_comments_agents' => $comments_agents,
            'total_review_comments_mentors' => $comments_mentors,
            'total_review_likes' => $likes,
            'total_review_likes_agents' => $like_comment_user,
            'total_review_likes_mentors' => $like_comment_mentor,

            'total_evocoins' => $coins_agents+$coins_mentors,
            'total_evocoins_agents' => $coins_agents,
            'total_evocoins_mentors' => $coins_mentors,
            'avg_evocoins_users' => number_format((float)(($coins_agents+$coins_mentors)/$users), 2, '.', ''),
            'avg_evocoins_agents' => number_format((float)($coins_agents/$agents), 2, '.', ''),
            'avg_evocoins_mentors' => number_format((float)($coins_mentors/$mentors), 2, '.', ''),
        );
        
        if ($model->save(false)) {
            $this->stdout("\n\nThe weekly general report was successfully saved\n\n", Console::FG_GREEN);
        } else{
            $this->stdout("\n\nThe weekly general report could not be saved\n\n", Console::FG_RED);
        }

    }
    
    public function saveUsersStats(){

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

        $success = 0;

        foreach ($users as $user):

            $model = new StatsUsers();

            $model->attributes = array(
                'user_id' => $user['id'],
                'username' => $user['username'],
                'number_evocoins' => $user['coins'],
                'number_followers' => $user['followers'],
                'number_followees' => $user['following'],
                'number_reviews' => $user['votes'],
                'number_evidences' => $user['evidences'],
                'user_or_mentor' => ($user['group_id'] == 1) ? Yii::t('StatsModule.base', 'User') : Yii::t('StatsModule.base', 'Mentor'),
                'read_novel' => ($user['has_read_novel'] == 1) ? 1 : 0 
            );

            if ($model->save(false)) {
                $success++;
            } 

        endforeach;

        if ($success > 0) {
            $this->stdout("\n\nThe weekly users report was successfully saved\n\n", Console::FG_GREEN);
        } else{
            $this->stdout("\n\nThe weekly users report could not be saved\n\n", Console::FG_RED);
        }

    }

    public function saveSpacesStats(){

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

        $success = 0;

        foreach ($spaces as $space):

            $model = new StatsSpaces();

            $model->attributes = array(
                'space_id' => $space['id'],
                'name' => $space['name'],

                'total_users' => $space['members'],
                'total_evidences' => $space['evidences'],
                'total_reviews' => $space['reviews']
            );

            if ($model->save(false)) {
                $success++;
            } 

        endforeach;

        if ($success > 0) {
            $this->stdout("\n\nThe weekly spaces report was successfully saved\n\n", Console::FG_GREEN);
        } else{
            $this->stdout("\n\nThe weekly spaces report could not be saved\n\n", Console::FG_RED);
        }

    }

    public function saveActivitiesStats(){

        $evidences = Evidence::find()->all();
        
        $activities = Activities::find()
        ->all();

        $success = 0;

        foreach ($activities as $activity):

            $model = new StatsActivities();

            $model->attributes = array(
                'activities_id' => $activity['id'],
                'mission_id' => $activity->mission['id'],
                'name' => $activity['title'],
                'mission_name' => $activity->mission['title'],

                'total_evidences' => count($evidences),
                'number_evidences' => count($activity->evidences),
                'avg_evidences' => number_format((float)(count($activity->evidences)/count($evidences)), 2, '.', ''),
            );

            if ($model->save(false)) {
                $success++;
            } 

        endforeach;

        if ($success > 0) {
            $this->stdout("\n\nThe weekly activities report was successfully saved\n\n", Console::FG_GREEN);
        } else{
            $this->stdout("\n\nThe weekly activities report could not be saved\n\n", Console::FG_RED);
        }

    }

}
