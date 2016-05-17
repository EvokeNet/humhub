<?php

use yii\db\Migration;

class m160508_012902_activities extends Migration
{
    public function up()
    {
        $this->createTable('activities', array(
            'id' => 'pk',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text NOT NULL',
            'mission_id' => 'int(11) NOT NULL',
            'created' => 'datetime NOT NULL',
            'modified' => 'datetime NOT NULL',
                ), '');
                
        $this->addForeignKey(
            'fk-activities-mission_id',
            'activities',
            'mission_id',
            'missions',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('activities');

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
