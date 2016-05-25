<?php

use yii\db\Migration;

class m160523_063721_translation extends Migration
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
                
        $this->createTable('matching_answer_translations', array(
            'id' => 'pk',
            'matching_answer_id' => 'int(16) NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');        
        
        $this->createTable('quality_translations', array(
            'id' => 'pk',
            'quality_id' => 'int(16) NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'name' => 'varchar(255) NOT NULL',
            'short_name' => 'varchar(255) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
        
        $this->createTable('superhero_identity_translations', array(
            'id' => 'pk',
            'superhero_identity_id' => 'int(16) NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'name' => 'varchar(255) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
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
        
        $this->addForeignKey(
            'fk-matching_answer_translations-matching_answer_id',
            'matching_answer_translations',
            'matching_answer_id',
            'matching_answers',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-quality_translations-quality_id',
            'quality_translations',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-superhero_identity_translations-superhero_identity_id',
            'superhero_identity_translations',
            'superhero_identity_id',
            'superhero_identities',
            'id',
            'CASCADE'
        );
        
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
        
        $this->addForeignKey(
            'fk-quality_translations-language_id',
            'quality_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-superhero_identity_translations-language_id',
            'superhero_identity_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->addColumn('matching_questions', 'id_code', $this->text());
        
        $this->addColumn('matching_answers', 'id_code', $this->text());
            
    }

    public function down()
    {
        //echo "m160523_063721_translation cannot be reverted.\n";
        
        $this->dropForeignKey('fk-matching_question_translations-matching_question_id', 'matching_question_translations');
        $this->dropForeignKey('fk-matching_answer_translations-matching_answer_id', 'matching_answer_translations');
        $this->dropForeignKey('fk-quality_translations-quality_id', 'quality_translations');
        $this->dropForeignKey('fk-superhero_identity_translations-superhero_identity_id', 'superhero_identity_translations');
        $this->dropForeignKey('fk-matching_question_translations-language_id', 'matching_question_translations');
        $this->dropForeignKey('fk-matching_answer_translations-language_id', 'matching_answer_translations');
        $this->dropForeignKey('fk-quality_translations-language_id', 'quality_translations');
        $this->dropForeignKey('fk-superhero_identity_translations-language_id', 'superhero_identity_translations');
        
        $this->dropTable('matching_question_translations');
        $this->dropTable('matching_answer_translations');
        $this->dropTable('quality_translations');
        $this->dropTable('superhero_identity_translations');

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
