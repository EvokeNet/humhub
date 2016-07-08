<?php

use yii\db\Migration;

class m160706_114100_image extends Migration
{
    public function up()
    {
        $this->addColumn('qualities', 'image', 'VARCHAR(256) NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('qualities', 'image');

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
