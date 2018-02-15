<?php

use yii\db\Migration;

class m180215_034107_quiz_questions extends Migration
{
    public function up()
    {
        $this->createTable('quiz_questions', array(
            'id' => 'pk',
            'question_headline' => 'text NOT NULL',
            'power_id' => 'int(11) NOT NULL',
            'level_id' => 'int(11) NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-quiz_questions-power_id',
            'quiz_questions',
            'power_id',
            'powers',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {

        $this->dropForeignKey('fk-quiz_questions-power_id', 'quiz_questions');
        
        $this->dropTable('quiz_questions');

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
