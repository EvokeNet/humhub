<?php

use yii\db\Migration;

class m160524_030706_translation extends Migration
{
    public function up()
    {
        $this->createTable('power_translations', array(
            'id' => 'pk',
            'power_id' => 'int(16) NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-power_translations-language_id',
            'power_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
          );
    }

    public function down()
    {
        //echo "m160524_030706_translation cannot be reverted.\n";
        
        $this->dropForeignKey('fk-power_translations-language_id', 'power_translations');
        
        $this->dropTable('power_translations');

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
