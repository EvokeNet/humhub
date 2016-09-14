<?php

use yii\db\Migration;

class m160914_045620_space_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_spaces', array(
            'id' => 'pk',
            'space_id' => 'int(32) NOT NULL',
            'name' => 'text NOT NULL',
            'total_users' => 'int(32) NOT NULL',
            'total_evidences' => 'int(32) NOT NULL',
            'total_reviews' => 'int(32) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        // echo "m160914_045620_space_stats cannot be reverted.\n";
        
        $this->dropTable('stats_spaces');
        
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
