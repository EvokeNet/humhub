<?php

use yii\db\Migration;

class m170130_163019_chapters_change extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk-novel-chapter_id', 'novel');
        $this->dropColumn('novel', 'chapter_id');

        $this->createTable('chapter_pages', array(
            'chapter_id' => 'int NOT NULL',
            'novel_id' => 'int NOT NULL',
            'created_at' => 'datetime NULL',
            'updated_at' => 'datetime NULL',
                ), '');

        $this->addPrimaryKey('chapter_pages_pk', 'chapter_pages', ['chapter_id', 'novel_id']);

        $this->addForeignKey(
        'fk-chapter_id',
        'chapter_pages',
        'chapter_id',
        'chapter',
        'id',
        'CASCADE'
        );

        $this->addForeignKey(
        'fk-novel_id',
        'chapter_pages',
        'novel_id',
        'novel',
        'id',
        'CASCADE'
        );

    }

    public function down()
    {
        
        $this->addColumn('novel', 'chapter_id', $this->integer());

        $this->addForeignKey(
            'fk-novel-chapter_id',
            'novel',
            'chapter_id',
            'chapter',
            'id',
            'CASCADE'
        );

        $this->dropForeignKey('fk-chapter_id', 'chapter_pages');
        $this->dropForeignKey('fk-novel_id', 'chapter_pages');
        $this->dropPrimaryKey('chapter_pages_pk', 'chapter_pages');
        $this->dropTable('chapter_pages');

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
