<?php

use yii\db\Migration;

class m160914_045558_general_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_general', array(
            'id' => $this->primaryKey(),
            'total_users' => $this->integer(32)->defaultValue(0),
            'total_agents' => $this->integer(32)->defaultValue(0),
            'total_mentors' => $this->integer(32)->defaultValue(0),
            
            'total_evidences' => $this->integer(32)->defaultValue(0),
            'avg_evidence_player' => $this->float(32)->defaultValue(0),
            'total_posts' => $this->integer(32)->defaultValue(0),
            'total_spaces' => $this->integer(32)->defaultValue(0),
            'total_teams' => $this->integer(32)->defaultValue(0),
            'total_images' => $this->integer(32)->defaultValue(0),
            'total_videos' => $this->integer(32)->defaultValue(0),
            'avg_evidence_words' => $this->float(32)->defaultValue(0),
            'total_comments' => $this->integer(32)->defaultValue(0),
            'total_comments_mentors' => $this->integer(32)->defaultValue(0),
            'total_comments_players' => $this->integer(32)->defaultValue(0),
            'comments_by_user' => $this->float(32)->defaultValue(0),
            
            'total_reviews' => $this->integer(32)->defaultValue(0),
            'avg_review_by_agents' => $this->float(32)->defaultValue(0),
            'avg_review_by_mentors' => $this->float(32)->defaultValue(0),
            'avg_review_received' => $this->float(32)->defaultValue(0),
            'avg_review_per_evidence' => $this->float(32)->defaultValue(0),
            'total_review_comments' => $this->integer(32)->defaultValue(0),
            'total_review_comments_agents' => $this->integer(32)->defaultValue(0),
            'total_review_comments_mentors' => $this->integer(32)->defaultValue(0),
            'total_review_likes' => $this->integer(32)->defaultValue(0),
            'total_review_likes_agents' => $this->integer(32)->defaultValue(0),
            'total_review_likes_mentors' => $this->integer(32)->defaultValue(0),

            'total_evocoins' => $this->integer(32)->defaultValue(0),
            'total_evocoins_agents' => $this->integer(32)->defaultValue(0),
            'total_evocoins_mentors' => $this->integer(32)->defaultValue(0),
            'avg_evocoins_users' => $this->float(32)->defaultValue(0),
            'avg_evocoins_agents' => $this->float(32)->defaultValue(0),
            'avg_evocoins_mentors' => $this->float(32)->defaultValue(0),

            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
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
