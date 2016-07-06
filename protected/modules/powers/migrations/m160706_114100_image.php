<?php

use yii\db\Migration;

class m160706_114100_image extends Migration
{
    public function up()
    {
        $this->addColumn('powers', 'image', 'VARCHAR(256) NOT NULL');
    }

    public function down()
    {
        echo "m160706_114100_image cannot be reverted.\n";

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
