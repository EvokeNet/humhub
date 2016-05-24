<?php

use yii\db\Migration;

class m160524_113645_powers extends Migration
{
    public function up()
    {
        $this->createTable('activity_powers', array(
            'id' => 'pk',
            'activity_id' => 'int(16) NOT NULL',
            'power_id' => 'int(16) NOT NULL',
            'flag' => 'int(16) NOT NULL', // flag to indicate if it's primary power or secondary power
            'value' => 'int(32) NOT NULL',
            'created_at' => 'datetime NULL',
            'modified_at' => 'datetime NULL',
                ), '');
                
        $this->addForeignKey(
        'fk-activity_powers-activity_id',
        'activity_powers',
        'activity_id',
        'activities',
        'id',
        'CASCADE'
        );
        
        $this->addForeignKey(
        'fk-activity_powers-power_id',
        'activity_powers',
        'power_id',
        'powers',
        'id',
        'CASCADE'
        );
    }

    public function down()
    {
        //echo "m160524_113645_powers cannot be reverted.\n";
        
        $this->dropForeignKey('fk-activity_powers-activity_id', 'activity_powers');
        $this->dropForeignKey('fk-activity_powers-power_id', 'activity_powers');
        
        $this->dropTable('activity_powers');
        
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
