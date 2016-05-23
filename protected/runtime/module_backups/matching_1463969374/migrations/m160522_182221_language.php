<?php

use yii\db\Migration;

class m160522_182221_language extends Migration
{
    public function up()
    {
        $this->addColumn('superhero_identity_translations', 'language_id', $this->integer('16'));
        
        $this->addForeignKey(
            'fk-superhero_identity_translations-language_id',
            'superhero_identity_translations',
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
    }

    public function down()
    {
        echo "m160522_182221_language cannot be reverted.\n";

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
