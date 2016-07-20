<?php

use yii\db\Migration;

class m160625_055456_lock extends Migration
{
    public function up()
    {
        $this->addColumn('missions', 'locked', 'INT(16) DEFAULT 0');
    }

    public function down()
    {
        echo "m160625_055456_lock cannot be reverted.\n";

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
