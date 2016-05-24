<?php

use yii\db\Migration;

class m160524_133221_skills extends Migration
{
    public function up()
    {
        $this->createTable('skills', array(
            'id' => 'pk',
            'activity_id' => 'int(16) NOT NULL',
            'power_id' => 'int(16) NOT NULL',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text DEFAULT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
                
        $this->addForeignKey(
        'fk-skills-activity_id',
        'skills',
        'activity_id',
        'activities',
        'id',
        'CASCADE'
        );
    }

    public function down()
    {
        //echo "m160524_133221_skills cannot be reverted.\n";
        
        $this->dropForeignKey('fk-skills-activity_id', 'skills');
        
        $this->dropTable('skills');

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
