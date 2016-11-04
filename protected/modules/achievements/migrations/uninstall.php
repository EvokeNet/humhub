<?php

use yii\db\Migration;

class uninstall extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk-achievement_id', 'user_achievements');
        $this->dropForeignKey('fk-user_id', 'user_achievements');
        $this->dropPrimaryKey('user_achievements_pk', 'user_achievements');
        $this->dropTable('user_achievements');
        $this->dropTable('achievements');
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
