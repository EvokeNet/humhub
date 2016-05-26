<?php

use yii\db\Migration;

class m160524_004111_difficulty extends Migration
{
    public function up()
    {
        $this->createTable('difficulty_levels', array(
            'id' => 'pk',
            'title' => 'varchar(256) NOT NULL',
            'points' => 'int(32) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
        
        $this->addColumn('activities', 'difficulty_level_id', $this->integer('16'));
        
        $this->addForeignKey(
            'fk-activities-difficulty_level_id',
            'activities',
            'difficulty_level_id',
            'difficulty_levels',
            'id',
            'CASCADE'
          );
          
    }

    public function down()
    {
        // echo "m160524_004111_difficulty cannot be reverted.\n";
        
        $this->dropForeignKey('fk-activities-difficulty_level_id', 'activities');
        
        $this->dropTable('difficulty_levels');

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
