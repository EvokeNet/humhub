<?php

use yii\db\Migration;

class m180302_034503_quiz_answer_translations extends Migration
{
    public function up()
    {
        $this->createTable('quiz_question_answer_translations', array(
            'id' => 'pk',
            'quiz_question_answer_id' => 'int(16) NOT NULL',
            'answer_headline' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
        
        $this->addForeignKey(
            'fk-quiz_question_answer_translations-language_id',
            'quiz_question_answer_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-quiz_question_answer_translations-quiz_question_answer_id',
            'quiz_question_answer_translations',
            'quiz_question_answer_id',
            'quiz_question_answers',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {

        $this->dropForeignKey('fk-quiz_question_answer_translations-language_id', 'quiz_question_answer_translations');
        $this->dropForeignKey('fk-quiz_question_answer_translations-quiz_question_answer_id', 'quiz_question_answer_translations');
        
        $this->dropTable('quiz_question_answer_translations');

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
