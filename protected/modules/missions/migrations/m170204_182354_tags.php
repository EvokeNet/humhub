<?php

use yii\db\Migration;

class m170204_182354_tags extends Migration
{
    public function up()
    {
        $this->createTable('tags', array(
            'id' => 'pk',
            'title' => 'varchar(120) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');

        $this->createTable('evidence_tags', array(
            'id' => 'pk',
            'tag_id' => 'int(16) NOT NULL',
            'evidence_id' => 'int(16) NOT NULL',
            'user_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');

        $this->addForeignKey(
            'fk-evidence_tags-tag_id',
            'evidence_tags',
            'tag_id',
            'tags',
            'id',
            'CASCADE'
        ); 

        $this->addForeignKey(
            'fk-evidence_tags-evidence_id',
            'evidence_tags',
            'evidence_id',
            'evidence',
            'id',
            'CASCADE'
        ); 

        $this->addForeignKey(
            'fk-evidence_tags-user_id',
            'evidence_tags',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );    
    }

    public function down()
    {
        // echo "m170204_182354_tags cannot be reverted.\n";

        $this->dropForeignKey('fk-evidence_tags-tag_id', 'tags');
        $this->dropForeignKey('fk-evidence_tags-evidence_id', 'evidence');
        $this->dropForeignKey('fk-evidence_tags-user_id', 'user');
        
        $this->dropTable('tags');

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
