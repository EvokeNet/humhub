<?php

use yii\db\Migration;

class uninstall extends Migration
{
    public function up()
    {
        $this->dropTable('mission_translations');
        $this->dropTable('activity_translations');
        $this->dropTable('evidence');
        $this->dropTable('activities');
        $this->dropTable('missions');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";

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
