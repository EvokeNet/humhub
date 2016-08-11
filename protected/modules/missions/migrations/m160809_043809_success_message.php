<?php

use yii\db\Migration;

class m160809_043809_success_message extends Migration
{
    public function up()
    {
        $this->addColumn('activities', 'message', 'varchar(256) NOT NULL');
        $this->addColumn('activity_translations', 'message', 'varchar(256) NOT NULL');
    }

    public function down()
    {
        echo "m160809_043809_success_message cannot be reverted.\n";

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
