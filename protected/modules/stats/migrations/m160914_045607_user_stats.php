<?php

use yii\db\Migration;

class m160914_045607_user_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_users', array(
            'id' => 'pk',
            'user_id' => 'int(32) NOT NULL',
            'username' => 'text NOT NULL',
            'number_evocoins' => 'int(32) NOT NULL',
            'number_followers' => 'int(32) NOT NULL',
            'number_followees' => 'int(32) NOT NULL',
            'number_reviews' => 'int(32) NOT NULL',
            'number_evidences' => 'int(32) NOT NULL',
            'user_or_mentor' => 'int(32) NOT NULL',
            'read_novel' => 'int(32) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        // echo "m160914_045607_user_stats cannot be reverted.\n";
        
        $this->dropTable('stats_users');
        
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
