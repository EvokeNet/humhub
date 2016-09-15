<?php

use yii\db\Migration;

class m160914_045607_user_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_users', array(
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(32)->defaultValue(0),
            'username' => $this->text(),

            'number_evocoins' => $this->integer(32)->defaultValue(0),
            'number_followers' => $this->integer(32)->defaultValue(0),
            'number_followees' => $this->integer(32)->defaultValue(0),
            'number_reviews' => $this->integer(32)->defaultValue(0),
            'number_evidences' => $this->integer(32)->defaultValue(0),
            'user_or_mentor' => $this->string(),
            'read_novel' => $this->integer(32)->defaultValue(0),
            
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
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
