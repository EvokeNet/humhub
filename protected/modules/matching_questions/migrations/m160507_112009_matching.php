<?php

use yii\db\Migration;

class m160507_112009_matching extends Migration
{
    public function up()
    {
        $this->createTable('matching_questions', array(
            'id' => 'pk',
            'description' => 'varchar(255) NOT NULL',
            'type' => 'varchar(255) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');
                
        $this->createTable('matching_answers', array(
            'id' => 'pk',
            'description' => 'varchar(255) NOT NULL',
            'matching_question_id' => 'int(11) NOT NULL',
            'social_innovator_quality_id' => 'int(11) NOT NULL',
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
    }

    public function down()
    {
        echo "m160507_112009_matching cannot be reverted.\n";

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
