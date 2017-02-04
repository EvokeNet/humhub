<?php

use yii\db\Migration;

class m170204_214727_tags_translation extends Migration
{
    public function up()
    {
        $this->createTable('tag_translations', array(
            'id' => 'pk',
            'tag_id' => 'int(16) NOT NULL',
            'title' => 'varchar(120) NOT NULL',
            'description' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
        
        $this->addForeignKey(
            'fk-tag_translations-language_id',
            'tag_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-tag_translations-tag_id',
            'tag_translations',
            'tag_id',
            'tags',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // echo "m170204_214727_tags_translation cannot be reverted.\n";

        $this->dropForeignKey('fk-tag_translations-language_id', 'tag_translations');
        $this->dropForeignKey('fk-tag_translations-tag_id', 'tag_translations');
        
        $this->dropTable('tag_translations');

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
