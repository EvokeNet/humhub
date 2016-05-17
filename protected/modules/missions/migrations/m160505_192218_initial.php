<?php

use yii\db\Migration;

class m160505_192218_initial extends Migration
{
    public function up()
    {
        $this->createTable('missions', array(
            'id' => 'pk',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text DEFAULT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        $this->dropTable('missions');

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
