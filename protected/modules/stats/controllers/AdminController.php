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
use app\modules\coin\models\Coin;
use app\modules\missions\models\Votes;
use app\modules\prize\models\SlotMachineStats;
use humhub\modules\space\models\Membership;

use app\modules\stats\models\StatsActivities;
use app\modules\stats\models\StatsGeneral;
use app\modules\stats\models\StatsUsers;
use app\modules\stats\models\StatsSpaces;

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
            count(distinct c.id) as evidences,
            count(distinct v.id) as votes,
            count(distinct f.id) as followers,
            count(distinct fg.id) as following,
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
            count(distinct u.id) as members,
            count(distinct e.id) as evidences,
            count(distinct v.id) as reviews
            '])
        ->from('space as s')
        ->join('LEFT JOIN', 'space_membership as m', 's.id = `m`.`space_id`')
        ->join('LEFT JOIN', 'votes as v', 'm.user_id = `v`.`user_id`')
        ->join('LEFT JOIN', 'user as u', 'm.user_id = `u`.`id`')
        ->join('LEFT JOIN', 'content as c', 's.id = `c`.`space_id`')
        ->join('LEFT JOIN', 'evidence as e', '`c`.`object_model`=\''.str_replace("\\", "\\\\", Evidence::classname()).'\' AND `c`.`object_id` = `e`.`id`')
        ->where('s.is_team = 1')
        ->andWhere(['m.status' => Membership::STATUS_MEMBER])
        ->groupBy('s.id')
        // ->orderBy('reviews desc')

        ->all();

        return $this->render('space-stats', array(
            'spaces' => $spaces,
        ));
    }

    public function actionEvocoinStats(){
      $coin = Wallet::find()->sum('amount');
      $total_coin_created = Coin::find()->where(['name' => 'evocoin'])->one()->total_created;
      $slot_machine_stats = SlotMachineStats::find()->where(['id' => 1])->one();
      $evocoin_from_reviews = Votes::find()->count() * 5;
      $evocoin_from_comments = Votes::find()->where(['comment' => 'NOT NULL'])->count() * 5;

      return $this->render('evocoin-stats', [
        'total_coin' => $coin,
        'total_coin_created' => $total_coin_created,
        'slot_machine_stats' => $slot_machine_stats,
        'evocoin_from_reviews' => $evocoin_from_reviews,
        'evocoin_from_comments' => $evocoin_from_comments
      ]);
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

    public function actionExports() {

        // $this->autoRender = false;
        // Yii::app()->end();

		//create a file
		$filename = "weekly_report_general_stats.csv";
		$csv_file = fopen('php://output', 'w');

		header('Content-type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		//$results = $this->ModelName->query($sql);	// This is your sql query to pull that data you need exported
		//or
		// $this->loadModel('Ava');
		// $results = $this->Ava->find('all');

		// The column headings of your .csv file
		// $header_row = array('AVA', utf8_decode('Endereço do AVA'), utf8_decode('Descrição'), 'Quantidade de Cursos', 'Quantidade de Alunos Matriculados');

		$header_row = array(
            'Week ended on',

            'Total number of Users',
            'Total number of Agents',
            'Total number of Mentors',

            'Number of Evidences',
            'Average number of evidences per player',
            'Number of Status Updates (Posts)',
            'Number of Spaces Created',
            'Number of Teams',
            'Number of Images Posted',
            'Number of Videos Posted',
            'Average size of evidence in number of words',
            'Total number of comments',
            'Total number of comments provided by agents',
            'Total number of comments provided by mentors',
            'Number of comments per user',

            'Total number of Reviews',
            'Average of Reviews by Agents',
            'Average of Reviews by Mentors',
            'Average number of reviews received per player',
            'Average number of reviews per evidence',
            'Total number of Comments',
            'Number of Comments by Agents',
            'Number of Comments by Agents',
            'Total number of likes',
            'Number of liken given by Agents',
            'Number of liken given by Mentors',

            'Total Number of Evocoins',
            'Total Number Earned by Agents',
            'Total Number Earned by Mentors',
            'Average number of Evocoin per total number of Participants',
            'Average number of Evocoin earned by Agents',
            'Average number of Evocoin earned by Mentors',
        );

		fputcsv($csv_file, $header_row);

        $stats = StatsGeneral::find()->all();

        foreach($stats as $stat):
            $row = array();

            $date = date_create($stat['created_at']);
            // date_sub($week, date_interval_create_from_date_string('6 days'));
            array_push($row, date_format($date, "Y-m-d"));

            array_push($row, $stat['total_users']);
            array_push($row, $stat['total_agents']);
            array_push($row, $stat['total_mentors']);

            array_push($row, $stat['total_evidences']);
            array_push($row, $stat['avg_evidence_player']);
            array_push($row, $stat['total_posts']);
            array_push($row, $stat['total_spaces']);
            array_push($row, $stat['total_teams']);
            array_push($row, $stat['total_images']);
            array_push($row, $stat['total_videos']);
            array_push($row, $stat['avg_evidence_words']);
            array_push($row, $stat['total_comments']);
            array_push($row, $stat['total_comments_mentors']);
            array_push($row, $stat['total_comments_players']);
            array_push($row, $stat['comments_by_user']);

            array_push($row, $stat['total_reviews']);
            array_push($row, $stat['avg_review_by_agents']);
            array_push($row, $stat['avg_review_by_mentors']);
            array_push($row, $stat['avg_review_received']);
            array_push($row, $stat['avg_review_per_evidence']);
            array_push($row, $stat['total_review_comments']);
            array_push($row, $stat['total_review_comments_agents']);
            array_push($row, $stat['total_review_comments_mentors']);
            array_push($row, $stat['total_review_likes']);
            array_push($row, $stat['total_review_likes_agents']);
            array_push($row, $stat['total_review_likes_mentors']);

            array_push($row, $stat['total_evocoins']);
            array_push($row, $stat['total_evocoins_agents']);
            array_push($row, $stat['total_evocoins_mentors']);
            array_push($row, $stat['avg_evocoins_users']);
            array_push($row, $stat['avg_evocoins_agents']);
            array_push($row, $stat['avg_evocoins_mentors']);

            fputcsv($csv_file, $row);
        endforeach;

		fclose($csv_file);

        exit();
	}

    public function actionExportsUsers($date = null) {

        $week = date_create($date);

		$filename = "weekly_report_users_stats_".date_format($week, "Y-m-d").".csv";
		$csv_file = fopen('php://output', 'w');

		header('Content-type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		$header_row = array(
            'Week ended on',

            'Username',
            'Number of Evocoins',
            'Number of Followers',

            'Number of Followees',
            'Number of Reviews',
            'Number of Evidences',

            'User or Mentor?',
            'Has read novel?',
        );

		fputcsv($csv_file, $header_row);

        $stats = StatsUsers::find()->where(['created_at' => $date])->all();

        foreach($stats as $stat):
            $row = array();

            $date = date_create($stat['created_at']);
            // date_sub($week, date_interval_create_from_date_string('6 days'));
            array_push($row, date_format($date, "Y-m-d"));

            array_push($row, $stat['username']);
            array_push($row, $stat['number_evocoins']);
            array_push($row, $stat['number_followers']);
            array_push($row, $stat['number_followees']);
            array_push($row, $stat['number_reviews']);
            array_push($row, $stat['number_evidences']);
            array_push($row, $stat['user_or_mentor']);
            array_push($row, ($stat['read_novel'] == 1) ? 'Yes' : 'No');

            fputcsv($csv_file, $row);
        endforeach;

		fclose($csv_file);

        exit();
	}

    public function actionExportsSpaces($date = null) {

        $week = date_create($date);

		$filename = "weekly_report_spaces_stats_".date_format($week, "Y-m-d").".csv";
		$csv_file = fopen('php://output', 'w');

		header('Content-type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$filename.'"');

		$header_row = array(
            'Week ended on',

            'Name',
            'Number of Members',
            'Number of Evidences',
            'Number of Reviews',
        );

		fputcsv($csv_file, $header_row);

        $stats = StatsSpaces::find()->where(['created_at' => $date])->all();

        foreach($stats as $stat):
            $row = array();

            $date = date_create($stat['created_at']);
            // date_sub($week, date_interval_create_from_date_string('6 days'));
            array_push($row, date_format($date, "Y-m-d"));

            array_push($row, $stat['name']);
            array_push($row, $stat['total_users']);
            array_push($row, $stat['total_evidences']);
            array_push($row, $stat['total_reviews']);

            fputcsv($csv_file, $row);
        endforeach;

		fclose($csv_file);

        exit();
	}

    public function actionExportsActivities($date = null) {

        $week = date_create($date);

		$filename = "weekly_report_activities_stats_".date_format($week, "Y-m-d").".csv";
		$csv_file = fopen('php://output', 'w');

		header('Content-type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="'.$filename.'"');

        $stats = StatsActivities::find()->where(['created_at' => $date])->all();

        $header_row = array('Total Number of Evidences Created: '.$stats[0]['total_evidences']);

		$header_row1 = array(
            'Week ended on',

            'Activity',
            'Mission',
            'Number of Evidences',

            'Average of Evidences for this Activity',

        );

        fputcsv($csv_file, $header_row);
		fputcsv($csv_file, $header_row1);

        foreach($stats as $stat):
            $row = array();

            $date = date_create($stat['created_at']);
            // date_sub($week, date_interval_create_from_date_string('6 days'));
            array_push($row, date_format($date, "Y-m-d"));

            array_push($row, $stat['name']);
            array_push($row, $stat['mission_name']);
            array_push($row, $stat['number_evidences']);
            array_push($row, $stat['avg_evidences']);

            fputcsv($csv_file, $row);
        endforeach;

		fclose($csv_file);

        exit();
	}

}
