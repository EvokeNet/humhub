<?php

use yii\db\Migration;

class m180215_034128_quiz_question_answers extends Migration
{
    public function up()
    {
        $this->createTable('quiz_question_answers', array(
            'id' => 'pk',
            'answer_headline' => 'text NOT NULL',
            'quiz_question_id' => 'int(11) NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-quiz_question_answers-quiz_question_id',
            'quiz_question_answers',
            'quiz_question_id',
            'quiz_questions',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {

        $this->dropForeignKey('fk-quiz_question_answers-quiz_question_id', 'quiz_question_answers');
        
        $this->dropTable('quiz_question_answers');

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
