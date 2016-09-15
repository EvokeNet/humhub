<?php

use yii\db\Migration;

class m160914_045620_space_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_spaces', array(
            'id' => $this->primaryKey(),
            'space_id' => $this->integer(32)->defaultValue(0),
            'name' => $this->text(),

            'total_users' => $this->integer(32)->defaultValue(0),
            'total_evidences' => $this->integer(32)->defaultValue(0),
            'total_reviews' => $this->integer(32)->defaultValue(0),
            
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
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
