<?php

use yii\db\Migration;

class m161027_203622_quality_review extends Migration
{
    public function up()
    {
        $this->addColumn('votes', 'quality', 'INT(3) DEFAULT 0');
    }

    public function down()
    {
        // echo "m161027_203622_quality_review cannot be reverted.\n";

        $this->dropColumn('votes', 'quality');

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
