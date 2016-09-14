<?php

use yii\db\Migration;

class m160914_045637_activities_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_activities', array(
            'id' => 'pk',
            'activities_id' => 'int(32) NOT NULL',
            'evidence_id' => 'int(32) NOT NULL',
            'name' => 'text NOT NULL',
            'total_evidences' => 'int(32) NOT NULL',
            'avg_evidences' => 'float(32) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'updated_at' => 'datetime NOT NULL',
                ), '');
    }

    public function down()
    {
        // echo "m160914_045637_activities_stats cannot be reverted.\n";
        
        $this->dropTable('stats_activities');
        
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
