<?php

use yii\db\Migration;

class m180215_034235_quiz_user_answers extends Migration
{
    public function up()
    {
        $this->createTable('quiz_user_answers', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'quiz_question_id' => 'int(11) NOT NULL',
            'quiz_question_answer_id' => 'int(11) NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-quiz_user_answers-user_id',
            'quiz_user_answers',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-quiz_user_answers-quiz_question_id',
            'quiz_user_answers',
            'quiz_question_id',
            'quiz_questions',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-quiz_user_answers-quiz_question_answer_id',
            'quiz_user_answers',
            'quiz_question_answer_id',
            'quiz_question_answers',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m180215_034235_quiz_user_answers cannot be reverted.\n";

        $this->dropForeignKey('fk-quiz_user_answers-user_id', 'quiz_user_answers');
        $this->dropForeignKey('fk-quiz_user_answers-quiz_question_id', 'quiz_user_answers');
        $this->dropForeignKey('fk-quiz_user_answers-quiz_question_answer_id', 'quiz_user_answers');
        
        $this->dropTable('quiz_user_answers');

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
