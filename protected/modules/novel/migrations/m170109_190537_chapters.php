<?php

use yii\db\Migration;

class m170109_190537_chapters extends Migration
{
    public function up()
    {

        $this->createTable('chapter', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(),
            'mission_id' => $this->integer(),
        ]);

        $this->addColumn('novel', 'chapter_id', $this->integer());

        $this->addForeignKey(
            'fk-novel-chapter_id',
            'novel',
            'chapter_id',
            'chapter',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-chapter-mission_id',
            'chapter',
            'mission_id',
            'missions',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey('fk-chapter-mission_id', 'chapter');
        $this->dropForeignKey('fk-novel-chapter_id', 'novel');
        $this->dropColumn('novel', 'chapter_id');
        $this->dropTable('chapter');

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
