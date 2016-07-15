<?php

use yii\db\Migration;

class m160714_172639_deadline extends Migration
{
    public function up()
    {
        $this->createTable('evokation_deadline', array(
            'id' => 'pk',
            'start_date' => 'datetime NOT NULL',
            'finish_date' => 'datetime NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        // echo "m160714_172639_deadline cannot be reverted.\n";
        
        $this->dropTable('evokation_deadline');
        
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
