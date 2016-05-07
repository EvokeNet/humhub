<?php

use yii\db\Migration;

class m160503_201316_initial extends Migration
{
    public function up()
    {

        // $this->createTable('matching_answers', array(
        //     'id' => 'pk',
        //     'matching_question_id' => 'int(11) NOT NULL',
        //     'description' => 'varchar(255) NOT NULL',
        //     'social_innovator_quality_id' => 'int(11) NOT NULL',
        //     'created' => 'datetime NOT NULL',
        //     'modified' => 'datetime NOT NULL',
        //         ), '');

        // $this->createTable('matching_questions', array(
        //     'id' => 'pk',
        //     'description' => 'varchar(255) NOT NULL',
        //     'type' => 'varchar(255) NOT NULL',
        //     'created' => 'datetime NOT NULL',
        //     'modified' => 'datetime NOT NULL',
        //         ), '');

        $this->createTable('qualities', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'short_name' => 'varchar(255) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');

        $this->createTable('superhero_identities', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'quality_1' => 'int(11) NOT NULL',
            'quality_2' => 'int(11) NOT NULL',
            'primary_power' => 'int(11) NOT NULL',
            'secondary_power' => 'int(11) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');

    }

    public function down()
    {
        echo "m160503_201316_initial cannot be reverted.\n";

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
