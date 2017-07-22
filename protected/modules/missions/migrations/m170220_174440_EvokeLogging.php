<?php

use yii\db\Migration;

class m170220_174440_EvokeLogging extends Migration
{
    public function up()
    {
        $this->createTable('evoke_log', array(
            'id' => 'pk',
            'message' => 'text NOT NULL',
            'time' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {   
        $this->dropTable('evoke_log');
        return true;
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
