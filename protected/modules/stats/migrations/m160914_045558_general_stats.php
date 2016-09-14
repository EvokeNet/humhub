<?php

use yii\db\Migration;

class m160914_045558_general_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_general', array(
            'id' => 'pk',
            'total_users' => 'int(32) NOT NULL',
            'total_agents' => 'int(32) NOT NULL',
            'total_mentors' => 'int(32) NOT NULL',
            'total_evidences' => 'int(32) NOT NULL',
            'avg_evidence_player' => 'float(32) NOT NULL',
            'total_posts' => 'int(32) NOT NULL',
            'total_spaces' => 'int(32) NOT NULL',
            'total_teams' => 'int(32) NOT NULL',
            'total_images' => 'int(32) NOT NULL',
            'total_videos' => 'int(32) NOT NULL',
            'avg_evidence_words' => 'float(32) NOT NULL',
            'total_comments_mentors' => 'int(32) NOT NULL',
            'total_comments_players' => 'int(32) NOT NULL',
            'comments_by_user' => 'int(32) NOT NULL',
            'total_reviews' => 'int(32) NOT NULL',
            'avg_review_by_agents' => 'float(32) NOT NULL',
            'avg_review_by_mentors' => 'float(32) NOT NULL',
            'avg_review_per_player' => 'float(32) NOT NULL',
            'avg_review_per_evidence' => 'float(32) NOT NULL',
            'total_review_comments' => 'int(32) NOT NULL',
            'total_review_comments_agents' => 'int(32) NOT NULL',
            'total_review_comments_mentors' => 'int(32) NOT NULL',
            'total_review_likes' => 'int(32) NOT NULL',
            'total_review_likes_agents' => 'int(32) NOT NULL',
            'total_review_likes_mentors' => 'int(32) NOT NULL',
            'total_evocoins' => 'int(32) NOT NULL',
            'total_evocoins_agents' => 'int(32) NOT NULL',
            'total_evocoins_mentors' => 'int(32) NOT NULL',
            'avg_evocoins_agents' => 'float(32) NOT NULL',
            'avg_evocoins_mentors' => 'float(32) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        // echo "m160914_045558_general_stats cannot be reverted.\n";
        
        $this->dropTable('stats_general');
        
        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
