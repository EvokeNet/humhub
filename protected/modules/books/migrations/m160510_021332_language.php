<?php

use yii\db\Migration;

class m160510_021332_language extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'fk-book_translations-language_id',
            'book_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m160510_021332_language cannot be reverted.\n";

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
