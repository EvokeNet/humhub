<?php

use yii\db\Migration;

class m160510_015014_language extends Migration
{
    public function up()
    {
        $this->addColumn('book_translations', 'language', $this->text());
        $this->addColumn('book_translations', 'language_id', $this->integer('16'));
        $this->addColumn('book_translations', 'created_at', $this->datetime());
        $this->addColumn('book_translations', 'updated_at', $this->datetime());
    }

    public function down()
    {
        echo "m160510_015014_language cannot be reverted.\n";

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
