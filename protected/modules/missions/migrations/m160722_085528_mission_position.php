<?php

use yii\db\Migration;

class m160722_085528_mission_position extends Migration
{
    public function up()
    {
      $this->addColumn('missions', 'position', $this->integer('16'));
      $this->addColumn('activities', 'position', $this->integer('16'));
    }

    public function down()
    {
        //echo "m160722_085528_mission_position cannot be reverted.\n";

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
