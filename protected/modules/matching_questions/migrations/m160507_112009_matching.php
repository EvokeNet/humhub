<?php

use yii\db\Migration;

class m160507_112009_matching extends Migration
{
    public function up()
    {
        $this->createTable('matching_questions', array(
            'id' => 'pk',
            'description' => 'varchar(1000) NOT NULL',
            'type' => 'varchar(255) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');
                
        $this->createTable('matching_answers', array(
            'id' => 'pk',
            'description' => 'varchar(255) NOT NULL',
            'matching_question_id' => 'int(11) NOT NULL',
            'quality_id' => 'int(11) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');

        $this->createTable('user_matching_answers', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'matching_question_id' => 'int(11) NOT NULL',
            'matching_aswer_id' => 'int(11) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'order' => 'int(11) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');

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
                
        $this->addForeignKey(
            'fk-matching_answers-matching_question_id',
            'matching_answers',
            'matching_question_id',
            'matching_questions',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_matching_answers-matching_question_id',
            'user_matching_answers',
            'matching_question_id',
            'matching_questions',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_matching_answers-matching_answer_id',
            'user_matching_answers',
            'matching_aswer_id',
            'user_matching_answers',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_matching_answers-user_id',
            'user_matching_answers',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-matching_answers_quality',
            'matching_answers',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-superhero_quality_1',
            'superhero_identities',
            'quality_1',
            'qualities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-superhero_quality_2',
            'superhero_identities',
            'quality_2',
            'qualities',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        echo "m160507_112009_matching cannot be reverted.\n";

        return false;
    }
}