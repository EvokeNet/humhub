<?php

use yii\db\Migration;

class m160524_001902_initial extends Migration
{
    public function up()
    {
        $this->createTable('powers', array(
            'id' => 'pk',
            'title' => 'varchar(256) NOT NULL',
            'description' => 'text NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
                
        $this->createTable('user_powers', array(
            'id' => 'pk',
            'user_id' => 'int(16) NOT NULL',
            'power_id' => 'int(16) NOT NULL',
            'value' => 'int(32) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
          
          $this->createTable('user_qualities', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'quality_id' => 'int(11) NOT NULL',
            'total_value' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
                
          $this->createTable('quality_powers', array(
            'id' => 'pk',
            'quality_id' => 'int(11) NOT NULL',
            'power_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
         
          $this->addForeignKey(
            'fk-user_powers-user_id',
            'user_powers',
            'user_id',
            'user',
            'id',
            'CASCADE'
          );
          
          $this->addForeignKey(
            'fk-user_powers-power_id',
            'user_powers',
            'power_id',
            'powers',
            'id',
            'CASCADE'
          );
          
          $this->addForeignKey(
            'fk-user_qualities-user_id',
            'user_qualities',
            'user_id',
            'user',
            'id',
            'CASCADE'
          );
          
          $this->addForeignKey(
            'fk-user_qualities-quality_id',
            'user_qualities',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
          );
          
          $this->addForeignKey(
            'fk-quality_powers-power_id',
            'quality_powers',
            'power_id',
            'powers',
            'id',
            'CASCADE'
          );
          
          $this->addForeignKey(
            'fk-quality_powers-quality_id',
            'quality_powers',
            'quality_id',
            'qualities',
            'id',
            'CASCADE'
          );
                
    }

    public function down()
    {
        // echo "m160524_001902_initial cannot be reverted.\n";
        
        $this->dropForeignKey('fk-user_powers-user_id', 'user_powers');
        $this->dropForeignKey('fk-user_powers-power_id', 'user_powers');
        
        $this->dropForeignKey('fk-user_qualities-user_id', 'user_qualities');
        $this->dropForeignKey('fk-user_qualities-quality_id', 'user_qualities');
        
        $this->dropForeignKey('fk-quality_powers-power_id', 'quality_powers');
        $this->dropForeignKey('fk-quality_powers-quality_id', 'quality_powers');
        
        $this->dropTable('user_powers');
        $this->dropTable('user_qualities');
        $this->dropTable('quality_powers');
        $this->dropTable('powers');

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
