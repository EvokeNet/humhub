<?php

use yii\db\Migration;

class m160510_030846_translations extends Migration
{
    public function up()
    {
        $this->createTable('mission_translations', array(
            'id' => 'pk',
            'mission_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-mission_translations-mission_id',
            'mission_translations',
            'mission_id',
            'missions',
            'id',
            'CASCADE'
        );
        
        $this->createTable('activity_translations', array(
            'id' => 'pk',
            'activity_id' => 'int(16) NOT NULL',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'language_id' => 'int(16) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-activity_translations-activity_id',
            'activity_translations',
            'activity_id',
            'activities',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        echo "m160510_030846_translations cannot be reverted.\n";

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
