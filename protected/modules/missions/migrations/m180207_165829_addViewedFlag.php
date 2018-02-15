<?php

use yii\db\Migration;

class m180207_165829_addViewedFlag extends Migration
{
    public function up()
    {
        $this->addColumn('votes', 'viewed_flag', 'INT(3) DEFAULT 0');
    }

    public function down()
    {
        //echo "m180207_165829_addViewedFlag cannot be reverted.\n";
        $this->dropColumn('votes', 'viewed_flag');
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
