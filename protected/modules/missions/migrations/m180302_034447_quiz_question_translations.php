<?php

use yii\db\Migration;

class m180302_034447_quiz_question_translations extends Migration
{
    public function up()
    {
        $this->createTable('quiz_question_translations', array(
            'id' => 'pk',
            'quiz_question_id' => 'int(16) NOT NULL',
            'question_headline' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
        
        $this->addForeignKey(
            'fk-quiz_question_translations-language_id',
            'quiz_question_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-quiz_question_translations-quiz_question_id',
            'quiz_question_translations',
            'quiz_question_id',
            'quiz_questions',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {

        $this->dropForeignKey('fk-quiz_question_translations-language_id', 'quiz_question_translations');
        $this->dropForeignKey('fk-quiz_question_translations-quiz_question_id', 'quiz_question_translations');
        
        $this->dropTable('quiz_question_translations');

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
