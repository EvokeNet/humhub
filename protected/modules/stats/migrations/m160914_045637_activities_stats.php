<?php

use yii\db\Migration;

class m160914_045637_activities_stats extends Migration
{
    public function up()
    {
        $this->createTable('stats_activities', array(
            'id' => $this->primaryKey(),
            'activities_id' => $this->integer(32)->defaultValue(0),
            'mission_id' => $this->integer(32)->defaultValue(0),
            
            'name' => $this->text(),
            'mission_name' => $this->text(),

            'total_evidences' => $this->integer(32)->defaultValue(0),
            'number_evidences' => $this->integer(32)->defaultValue(0),
            'avg_evidences' => $this->float(32)->defaultValue(0),
            
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
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
