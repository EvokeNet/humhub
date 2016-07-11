<?php

use yii\db\Migration;

class m160707_215543_evokation extends Migration
{
    public function up()
    {
        $this->createTable('evokations', array(
            'id' => 'pk',
            'title' => 'varchar(120) NOT NULL',
            'description' => 'text NOT NULL',
            'youtube_url' => 'text NOT NULL',
            'gdrive_url' => 'text NOT NULL',
            'mission_id' => 'int(16) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(16) NOT NULL',
            'updated_at' => 'datetime NOT NULL',
            'updated_by' => 'int(16) NOT NULL',
                ), '');


        $this->addForeignKey(
            'fk-evokations-mission_id',
            'evokations',
            'mission_id',
            'missions',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        //echo "m160707_215543_evokation cannot be reverted.\n";
        
        $this->dropForeignKey('fk-evokations-mission_id', 'evokations');
        
        $this->dropTable('evokations');

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
