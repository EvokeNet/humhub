<?php

use yii\db\Migration;

class m160815_174030_description extends Migration
{
    public function up()
    {
        $this->alterColumn('user_matching_answers', 'description', 'text NOT NULL');
        $this->alterColumn('qualities', 'description', 'text NOT NULL');
        $this->alterColumn('superhero_identities', 'description', 'text NOT NULL');
    }

    public function down()
    {
        $this->alterColumn('user_matching_answers', 'description', 'varchar(255) NOT NULL');
        $this->alterColumn('qualities', 'description', 'varchar(255) NOT NULL');
        $this->alterColumn('superhero_identities', 'description', 'varchar(255) NOT NULL');

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
