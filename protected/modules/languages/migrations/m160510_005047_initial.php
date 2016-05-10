<?php

use yii\db\Migration;

class m160510_005047_initial extends Migration
{
    public function up()
    {
        $this->createTable('languages', array(
            'id' => 'pk',
            'language' => 'varchar(255) NOT NULL',
            'code' => 'varchar(255) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        echo "m160510_005047_initial cannot be reverted.\n";

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
