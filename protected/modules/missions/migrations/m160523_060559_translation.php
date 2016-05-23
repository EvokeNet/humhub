<?php

use yii\db\Migration;

class m160523_060559_translation extends Migration
{
    public function up()
    {
        $this->createTable('mission_translations', array(
            'id' => 'pk',
            'mission_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
        
        $this->createTable('activity_translations', array(
            'id' => 'pk',
            'activity_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-mission_translations-mission_id',
            'mission_translations',
            'mission_id',
            'missions',
            'id',
            'CASCADE'
        );
          
        $this->addForeignKey(
            'fk-activity_translations-activity_id',
            'activity_translations',
            'activity_id',
            'activities',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-mission_translations-language_id',
            'mission_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-activity_translations-language_id',
            'activity_translations',
            'language_id',
            'languages',
            'id',
            'CASCADE'
        );
        
        $this->addColumn('missions', 'id_code', $this->text());
        
        $this->addColumn('activities', 'id_code', $this->text());
        
    }

    public function down()
    {
        // echo "m160523_060559_translation cannot be reverted.\n";
        
        $this->dropForeignKey('fk-mission_translations-mission_id', 'mission_translations');
        $this->dropForeignKey('fk-activity_translations-activity_id', 'activity_translations');
        $this->dropForeignKey('fk-mission_translations-language_id', 'mission_translations');
        $this->dropForeignKey('fk-activity_translations-language_id', 'activity_translations');
        
        $this->dropTable('mission_translations');
        $this->dropTable('activity_translations');

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
