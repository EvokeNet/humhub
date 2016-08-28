<?php

use yii\db\Migration;

class m160830_183006_user_matching_answer extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk-user_matching_answers-matching_question_id', 'user_matching_answers');
        $this->dropColumn('user_matching_answers', 'matching_question_id');
        $this->dropColumn('user_matching_answers', 'description');

        $this->renameColumn('user_matching_answers', 'created_at', 'created_at');
        $this->renameColumn('user_matching_answers', 'modified_at', 'updated_at');

        $this->alterColumn('user_matching_answers', 'created_at', 'datetime');
        $this->alterColumn('user_matching_answers', 'updated_at', 'datetime');

        $this->dropForeignKey('fk-user_matching_answers-matching_answer_id', 'user_matching_answers');
        $this->renameColumn('user_matching_answers', 'matching_aswer_id', 'matching_answer_id');
        $this->addForeignKey(
            'fk-user_matching_answers-matching_answer_id',
            'user_matching_answers',
            'matching_answer_id',
            'matching_answers',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->addColumn('user_matching_answers', 'matching_question_id', 'int(11) NOT NULL');
        $this->addForeignKey(
            'fk-user_matching_answers-matching_question_id',
            'user_matching_answers',
            'matching_question_id',
            'matching_questions',
            'id',
            'CASCADE'
        );

        $this->addColumn('user_matching_answers', 'description', 'varchar(255) NOT NULL');

        $this->alterColumn('user_matching_answers', 'created_at', 'datetime NOT NULL');
        $this->alterColumn('user_matching_answers', 'updated_at', 'datetime NOT NULL');

        $this->renameColumn('user_matching_answers', 'created_at', 'created');
        $this->renameColumn('user_matching_answers', 'updated_at', 'modified_at');
        
        $this->dropForeignKey('fk-user_matching_answers-matching_answer_id', 'user_matching_answers');
        $this->renameColumn('user_matching_answers', 'matching_answer_id', 'matching_aswer_id');
        $this->addForeignKey(
            'fk-user_matching_answers-matching_answer_id',
            'user_matching_answers',
            'matching_aswer_id',
            'matching_answers',
            'id',
            'CASCADE'
        );



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
