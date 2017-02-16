<?php

use yii\db\Migration;

class m170216_172026_team_mission extends Migration
{
    public function up()
    {
        $this->createTable('team_mission', array(
            'space_id' => 'int NOT NULL',
            'mission_id' => 'int NOT NULL',
            'created_at' => 'datetime NULL',
            'updated_at' => 'datetime NULL',
                ), '');

        $this->addForeignKey(
            'fk-team_mission-space_id',
            'team_mission',
            'space_id',
            'space',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-team_mission-mission_id',
            'team_mission',
            'mission_id',
            'missions',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-team_mission-space_id', 'team_mission');
        $this->dropForeignKey('fk-team_mission-mission_id', 'team_mission');
        $this->dropTable('team_mission');

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
