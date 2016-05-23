<?php

use yii\db\Migration;

class m160510_161752_id_code extends Migration
{
    public function up()
    {
        $this->createTable('matching_question_translations', array(
            'id' => 'pk',
            'matching_question_id' => 'int(16) NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-matching_question_translations-matching_question_id',
            'matching_question_translations',
            'matching_question_id',
            'matching_questions',
            'id',
            'CASCADE'
        );
        
        $this->createTable('matching_answer_translations', array(
            'id' => 'pk',
            'matching_answer_id' => 'int(16) NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-matching_answer_translations-matching_answer_id',
            'matching_answer_translations',
            'matching_answer_id',
            'matching_answers',
            'id',
            'CASCADE'
        );
        
        $this->addColumn('matching_questions', 'id_code', $this->text());
        
        $this->addColumn('matching_answers', 'id_code', $this->text());
        
        $this->addForeignKey(
            'fk-matching_question_translations-language_id',
            'matching_question_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-matching_answer_translations-language_id',
            'matching_answer_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m160510_161752_id_code cannot be reverted.\n";

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
