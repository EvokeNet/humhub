<?php

use yii\db\Migration;

class m160522_174307_quality_translation extends Migration
{
    public function up()
    {
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
                
        $this->addForeignKey(
            'fk-quality_translations-quality_id',
            'quality_translations',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
        );
        
        $this->createTable('superhero_identity_translations', array(
            'id' => 'pk',
            'superhero_identity_id' => 'int(16) NOT NULL',
            'name' => 'varchar(255) NOT NULL',
            'description' => 'varchar(255) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-superhero_identity_translations-superhero_identity_id',
            'superhero_identity_translations',
            'superhero_identity_id',
            'superhero_identities',
            'id',
            'CASCADE'
        );
        
    }

    public function down()
    {
        echo "m160522_174307_quality_translation cannot be reverted.\n";

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
